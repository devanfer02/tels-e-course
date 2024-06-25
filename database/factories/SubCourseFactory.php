<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SubCourse;
use App\Models\Course;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subcourse>
 */
class SubCourseFactory extends Factory
{
    protected $model = SubCourse::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $courseIds = Course::select('id')->get();

        return [
            'id' => Uuid::uuid7(),
            'course_id' => $courseIds->random()->id,
            'subcourse_name' => fake()->sentence(),
            'content' => fake()->sentence()
        ];
    }
}
