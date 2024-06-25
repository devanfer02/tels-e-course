<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Services\CourseService;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
class CourseController extends Controller
{
    private $courseService;
    public function __construct()
    {
        $this->courseService = new CourseService;
    }

    public function getAllCourses()
    {
        try {
            $courses = $this->courseService->getAllCourses();

            return response()->json([
                'status' => 'successfully fetch mata pelajaran',
                'code' => Response::HTTP_OK,
                'courses' => $courses
            ], Response::HTTP_OK);

        } catch(\Exception $e) {
            return response()->json([
                'status' => 'failed to fetch mata pelajaran',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'err_message' => $e->getMessage()
            ],  Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function enrollCourse(Course $course)
    {
        if(!$course) {
            return response()->json([
                'message' => 'mata pelajaran tidak dapat ditemukan'
            ]);
        }

        $data = [
            'user_id' => auth()->user()->id,
            'course_id' => $course->id
        ];

        return $this->courseService->enrollCourse($data);
    }

    public function webEnrollCourse(Course $course)
    {
        $data = [
            'user_id' => auth('web')->user()->id,
            'course_id' => $course->id
        ];

        return $this->courseService->enrollCourse($data, "web");
    }

    public function getCourse(Course $course)
    {
        try {
            $course = $course->load(['subcourses' => function($query) {
                $query->orderBy('order', 'asc');
            }, 'subcourses.evaluation']);

            return response()->json([
                'status' => 'successfully fetch mata pelajaran',
                'code' => Response::HTTP_OK,
                'course' => $course
            ], Response::HTTP_OK);
        } catch(\Exception $e) {
            return response()->json([
                'status' => 'failed to fetch mata pelajaran',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'err_message' => $e->getMessage()
            ],  Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->rules(), $this->message());

        try {
            $courseId = $this->courseService->createCourse($request);

            return redirect(route('show-mapel', $courseId))->with('success', 'Berhasil menambahkan mata pelajaran');
        } catch(\Exception $e) {
            return redirect(route('mata-pelajaran'))->with('failed', 'Gagal menambahkan mata pelajaran');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $pageTitle = "Mata Pelajaran " . $course->course_name;

        $course = $course->load(['subcourses' => function($query) {
            $query->orderBy('order', 'asc');
        }], 'subcourses.evaluation');

        return view('pages.courses.detail', compact('course', 'pageTitle'));
    }

    public function showUser(Course $course)
    {
        $course = $course->load(['subcourses' => function($query) {
            $query->orderBy('order', 'asc');
        }], 'subcourses.evaluation');

        if (auth('web')->user()) {
            $course->load('userEnrollDetails')->whereHas('userEnrollDetails', function($query) {
                $query->where('user_id', '='. auth('web')->user()->id);
            });

            $course->setRelation('userEnrollDetails', $course->userEnrollDetails->first());
        }

        return view('pages.client.course.index', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $pageTitle = 'Edit Mapel ' . $course->course_name;
        return view('pages.courses.edit', compact('course', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate($this->rules("update"), $this->message());

        try {
            $this->courseService->updateCourse($request, $course);

            return redirect(route('show-mapel', $course->id))->with('success', 'Berhasil memperbarui mata pelajaran');
        } catch(\Exception $e) {
            return redirect(route('show-mapel', $course->id))->with('failed', 'Gagal memperbarui mata pelajaran');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        try {
            $this->courseService->deleteCourse($course);

            return redirect(route('mata-pelajaran'))->with('success', 'Berhasil menghapus mata pelajaran');
        } catch(\Exception $e) {
            return redirect(route('mata-pelajaran'))->with('failed', 'Gagal menghapus mata pelajaran');
        }
    }

    private function rules(string $rule = "add")
    {
        return [
            'mapel' => 'required|string|min:4',
            'kelas' => [
                'required',
                Rule::in(config('constants.grades'))
            ],
            'jurusan' => [
                'required',
                Rule::in(config('constants.majors'))
            ],
            'kurikulum' => [
                'required',
                Rule::in(config('constants.curricula'))
            ],
            'img' => $rule === "add" ? 'required|mimes:jpeg,jpg,png|max:4056' : 'mimes:jpeg,jpg,png|max:4056',
            'deskripsi' => 'required',
        ];
    }

    private function message()
    {
        return [
            'mapel.min' => 'Nama mata pelajaran harus memiliki mininal 4 karakter',
            'img.max' => 'Ukuran foto tidak boleh lebih dari 4MB',
            'img.mimes' => 'Foto yang diterima hanyalah jpg, png, jepg',
        ];
    }
}
