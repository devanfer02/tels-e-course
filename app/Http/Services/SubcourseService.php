<?php

namespace App\Http\Services;

use App\Models\SubCourse;
use App\Helpers\Logger;
use App\Models\Course;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Amp;

class SubcourseService
{
    public function getSubcourses($courseName = '')
    {
        $subcourses = SubCourse::whereHas('course', function($query) use($courseName) {
            return $query->where('course_name', '=', $courseName);
        })->orderBy('order','asc')->get();

        return $subcourses;
    }

    public function createSubcourse(Request $request, Course $course)
    {
        try {
            $request['course_id'] = $course->id;
            $request['id'] = Uuid::uuid7();

            $subcourse = Subcourse::create($request->all());
            AdminRecordService::recordLog('created materi ' . $subcourse->subcourse_name);
        } catch(\Exception $e) {
            Logger::errLog("[SUBCOURSE SERVICE]", $e->getMessage());
            throw $e;
        }
    }

    public function updateSubcourse(Request $request, Subcourse $subcourse)
    {
        try {
            AdminRecordService::recordLog('updated materi ' . $subcourse->subcourse_name);

            $subcourse->fill($request->all())->save();
        } catch(\Exception $e) {
            Logger::errLog('[SUBCOURSE SERVICE]', $e->getMessage());
            throw $e;
        }
    }

    public function deleteSubcourse(Subcourse $subcourse)
    {
        try {
            AdminRecordService::recordLog('deleted materi ' . $subcourse->subcourse_name);
            $subcourse->delete();
        } catch(\Exception $e) {
            Logger::errLog('[SUBCOURSE SERVICE]', $e->getMessage());
            throw $e;
        }
    }
}
