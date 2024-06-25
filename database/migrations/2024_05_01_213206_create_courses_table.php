<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('grade_id');
            $table->unsignedBigInteger('major_id');
            $table->unsignedBigInteger('curriculum_id');
            $table->string('course_name', 200)->nullable(false);
            $table->text('course_description')->nullable(false);
            $table->string('photo_link', 250)->nullable(false);
            $table->string('video_link', 250)->nullable(false);
            $table->timestamps();

            $table->foreign('grade_id')->references('id')->on('grades');
            $table->foreign('major_id')->references('id')->on('majors');
            $table->foreign('curriculum_id')->references('id')->on('curricula');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
