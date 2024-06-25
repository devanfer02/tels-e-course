<?php

namespace App\Http\Controllers;

use App\Models\SubCourse;
use App\Models\Course;
use Amp;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Services\SubcourseService;

class SubCourseController extends Controller
{
    private $subcourseService;
    public function __construct()
    {
        $this->subcourseService = new SubcourseService();
    }

    public function getSubCourse(SubCourse $subCourse)
    {
        try {
            $subCourse = $subCourse->load('course');

            return response()->json([
                'status'=> 'successfull fetch materi',
                'code' => Response::HTTP_OK,
                'materi' => $subCourse
            ], Response::HTTP_OK);
        } catch(\Exception $e) {
            return response()->json([
                'status'=> 'internal server error',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getSubCoursesByCourse(Course $course)
    {
        try {
            $courseW = $course->load(['subcourses' => function($query) {
                $query->orderBy('order', 'asc');
            }, 'subcourses.evaluation']);

            return response()->json([
                'status'=> 'successfull fetch materi',
                'code' => Response::HTTP_OK,
                'course' => $course,
                'subcourses' => $courseW->subcourses
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status'=> 'internal server error',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Course $course)
    {
        $request->validate($this->rules(), $this->messages());

        try {
            $this->subcourseService->createSubcourse($request, $course);
            return redirect(route('show-mapel', $course->id))->with('success', 'Berhasil menambahkan materi');
        } catch(\Exception $e) {
            return redirect(route('show-mapel', $course->id))->with('failed', 'Gagal menambahkan materi');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course, SubCourse $subCourse)
    {
        $pageTitle = 'Materi ' . $subCourse->subcourse_name;
        return view('pages.subcourses.detail', compact('pageTitle', 'subCourse', 'course'));
    }

    public function showUser(Course $course, SubCourse $subCourse)
    {
        $course->load(['subcourses' => function($query) {
            $query->orderBy('order', 'asc');
        }], 'subcourses.evaluation');

        $subCourse->load('evaluation');

        return view('pages.client.subcourse.index', compact('subCourse', 'course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course, SubCourse $subCourse)
    {
        $pageTitle = 'Edit materi ' . $subCourse->subcourse_name;
        return view('pages.subcourses.edit', compact('pageTitle', 'subCourse'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCourse $subCourse)
    {
        $request->validate($this->rules(), $this->messages());
        $subCourse = $subCourse->load('course');

        try {
            $this->subcourseService->updateSubcourse($request, $subCourse);

            return redirect(route('show-mapel', $subCourse->course->id))->with('success', 'Berhasil memperbarui materi');
        } catch(\Exception $e) {
            return redirect(route('show-mapel', $subCourse->course->id))->with('failed', 'Gagal memperbarui materi');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course, SubCourse $subCourse)
    {
        try {
            $this->subcourseService->deleteSubcourse($subCourse);

            return redirect(route('show-mapel', $course->id))->with('success', 'Berhasil menghapus materi');
        } catch(\Exception $e) {
            return redirect(route('show-mapel', $course->id))->with('failed', 'Gagal menghapus materi');
        }
    }

    private function rules()
    {
        return [
            'subcourse_name' => 'required|string|min:3',
            'content' => 'required|string',
            'order' => 'required|integer|min:1'
        ];
    }

    private function messages()
    {
        return [
            'subcourse_name.min' => 'Nama materi harus memiliki minimal 3 karakter',
            'order.min' => 'Urutan materi harus memiliki nilai minimal 1'
        ];
    }
}
