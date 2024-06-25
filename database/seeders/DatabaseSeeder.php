<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Major;
use App\Models\Curriculum;
use App\Models\EvaluationCategory;
use App\Models\QuestionCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Grade::insert(array_map(function($value) {
            return ['grade_name' => $value];
        }, config('constants.grades')));

        Major::insert(array_map(function($value) {
            return ['major_name' => $value];
        }, config('constants.majors')));

        Curriculum::insert(array_map(function($value) {
            return ['curriculum_name' => $value ];
        }, config('constants.curricula')));

        EvaluationCategory::insert(array_map(function($value) {
            return ['category_name' => $value];
        }, config('constants.evaluations')));

        QuestionCategory::insert(array_map(function($value) {
            return ['category_name' => $value];
        }, config('constants.questions')));
    }
}
