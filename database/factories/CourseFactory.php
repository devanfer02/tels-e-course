<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Course;
use App\Models\Curriculum;
use App\Models\Major;
use App\Models\Grade;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    protected $model = Course::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $grades = Grade::all();
        $majors = Major::all();
        $curricula = Curriculum::all();

        if($grades->isEmpty() || $majors->isEmpty() || $curricula->isEmpty() ) {
            error_log("Default Collection is Empty");
            return [

            ];
        }

        return [
            'id' => Uuid::uuid7(),
            'grade_id' => $grades->random()->id,
            'major_id' => $majors->random()->id,
            'curriculum_id' => $curricula->random()->id,
            'course_name' => fake()->sentence(rand(1,3), true),
            'course_description' => fake()->paragraph(),
            'photo_link' => '',
            'video_link' => '',
        ];
    }
}
