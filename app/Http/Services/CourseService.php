<?php

namespace App\Http\Services;

use App\Models\Course;
use App\Models\Grade;
use App\Models\Major;
use App\Models\Curriculum;
use Ramsey\Uuid\Uuid;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Models\UserEnrollDetail;
use App\Http\Services\AdminRecordService;
use Amp;
use Illuminate\Http\Response;

class CourseService
{
    private $fileStorage;
    public function __construct()
    {
        $this->fileStorage = new FileStorage();
    }
    public function getAllCourses($pagination = null, $filters = [])
    {
        $courses = Course::latest()->with(['major', 'grade', 'curriculum'])->filter($filters);
        if($pagination && gettype($pagination) === 'integer') {
            $courses = $courses->paginate($pagination);
        } else {
            $courses = $courses->get();
        }

        return $courses;
    }

    public function getCourseByName(string $courseName)
    {
        $course = Course::where('course_name', '=', $courseName)->first();

        return $course;
    }

    public function createCourse(Request $request)
    {
        try {
            // TASK 1
            $photoLink = Amp\async(function() use($request) {
                $photoLink = $this->fileStorage->upload($request, 'courses/');
                return $photoLink;
            });

            // TASK 2
            $categories = Amp\async(function () use($request) {
                $gradeId = Grade::where('grade_name', '=', $request['kelas'])->first()['id'];
                $majorId = Major::where('major_name', '=', $request['jurusan'])->first()['id'];
                $curriculumId = Curriculum::where('curriculum_name', '=', $request['kurikulum'])->first()['id'];

                return [
                    'grade_id' => $gradeId,
                    'major_id' => $majorId,
                    'curriculum_id' => $curriculumId
                ];
            });

            $photoLink = $photoLink->await();
            $categories = $categories->await();
            $courseId = Uuid::uuid7();

            $course = [
                'id' => $courseId,
                'grade_id' => $categories['grade_id'],
                'major_id' => $categories['major_id'],
                'curriculum_id' => $categories['curriculum_id'],
                'course_name' => $request['mapel'],
                'course_description' => $request['deskripsi'],
                'photo_link' => $photoLink,
                'video_link' => $request['preview']
            ];

            $course = Course::create($course);

            AdminRecordService::recordLog('created mata pelajaran ' . $course->course_name);

            return $courseId;
        } catch(\Exception $e) {
            Logger::errLog("[COURSE SERVICE]", $e->getMessage());
            throw $e;
        }
    }

    public function updateCourse(Request $request, Course $course)
    {
        try {
            // UPDATE LOGIC
            $photoLink = null;

            if ($request['img']) {
                $photoLink = Amp\async(function() use($request) {
                    $photoLink = $this->fileStorage->upload($request, 'courses/');
                    return $photoLink;
                });

                if (!empty($course->photo_link)) {
                    Amp\async(function() use($course) {
                        $this->fileStorage->delete($course->photo_link, 'courses');
                    });
                }
            }


            $categories = Amp\async(function () use($request, $course) {
                $gradeId = $course->grade->id;
                $majorId = $course->major->id;
                $curriculumId = $course->curriculum->id;

                if($request['kelas'] !== $course->grade->grade_name) {
                    $gradeId = Grade::where('grade_name', '=', $request['kelas'])->first()['id'];
                }
                if($request['jurusan'] !== $course->grade->grade_name) {
                    $majorId = Major::where('major_name', '=', $request['jurusan'])->first()['id'];
                }
                if($request['kurikulum'] !== $course->grade->grade_name) {
                    $curriculumId = Curriculum::where('curriculum_name', '=', $request['kurikulum'])->first()['id'];
                }

                return [
                    'grade_id' => $gradeId,
                    'major_id' => $majorId,
                    'curriculum_id' => $curriculumId
                ];
            });

            $categories =  $categories->await();
            if ($photoLink)
                $photoLink = $photoLink->await();
            else
                $photoLink = $course->photo_link;

            $data = [
                'grade_id' => $categories['grade_id'],
                'major_id' => $categories['major_id'],
                'curriculum_id' => $categories['curriculum_id'],
                'course_name' => $request['mapel'],
                'course_description' => $request['deskripsi'],
                'photo_link' => $photoLink,
                'video_link' => $request['preview']
            ];

            $course->fill($data)->save();

            AdminRecordService::recordLog('updated mata pelajaran ' . $course->course_name);

        } catch(\Exception $e) {
            Logger::errLog("[COURSE SERVICE]", $e->getMessage());
            throw $e;
        }
    }

    public function deleteCourse(Course $course)
    {
        try {
            Amp\async(function() use($course) {
                $this->fileStorage->delete($course->course_name, 'courses');
            });

            AdminRecordService::recordLog('deleted mata pelajaran ' . $course->course_name);

            $course->delete();

        } catch(\Exception $e) {
            Logger::errLog("[COURSE SERVICE]", $e->getMessage());
            throw $e;
        }
    }

    public function enrollCourse($data,  $mode = "api"){
        try {
            if (UserEnrollDetail::where('user_id', '=', $data['user_id'])
            ->where('course_id', '=', $data['course_id'])->exists()) {

                if ($mode == "api") {
                    return response()->json([
                        'message'=>'user already enrolled to mapel'
                    ]);
                }
            }

            $userEnrollDetail = new UserEnrollDetail();
            $userEnrollDetail->user_id = $data['user_id'];
            $userEnrollDetail->course_id = $data['course_id'];
            $userEnrollDetail->progress = 0.0;
            $userEnrollDetail->save();

            if ($mode == "api") {
                return response()->json([
                    'message' => 'successfully enrolled mapel',
                    'code' => Response::HTTP_CREATED
                ], Response::HTTP_CREATED);
            }

            return redirect()->back()->with('success', 'Successfully enrolled to course');

        } catch(\Exception $e) {
            Logger::errLog("[COURSE SERVICE]", $e->getMessage());

            return response()->json([
                'message' => 'failed enrolled mapel',
                'error' => $e->getMessage(),
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
