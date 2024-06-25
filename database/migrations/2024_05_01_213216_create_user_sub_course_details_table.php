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
        Schema::create('user_subcourse_details', function (Blueprint $table) {
            $table->uuid('user_id')->index('user_id_index');
            $table->uuid('evaluation_id');
            $table->uuid('subcourse_id');
            $table->timestamp('done_at')->nullable()->default(null);
            $table->timestamp('last_visit_at')->nullable()->default(null);
            $table->double('evaluation_grade')->default(0);
            $table->timestamps();

            $table->foreign('evaluation_id')->references('id')->on('evaluations')->onDelete('cascade');
            $table->foreign('subcourse_id')->references('id')->on('subcourses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_sub_course_details');
    }
};
