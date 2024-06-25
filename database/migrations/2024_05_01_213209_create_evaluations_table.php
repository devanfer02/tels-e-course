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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('subcourse_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedInteger('minimum_competency');
            $table->timestamps();

            $table->foreign('subcourse_id')->references('id')->on('subcourses')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('evaluation_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
