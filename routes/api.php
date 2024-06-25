<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\SubCourseController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

Route::controller(AuthController::class)->group(function() {
    Route::post('login', 'login');
    Route::post('register', 'register');
});

Route::controller(CourseController::class)->group(function() {
    Route::get('mapels', 'getAllCourses');
    Route::get('mapels/{course}', 'getCourse');
});

Route::controller(SubCourseController::class)->group(function() {
    Route::get('materi/{subCourse}', 'getSubCourse');
    Route::get('mapel/materi/{course}', 'getSubCoursesByCourse');
});

Route::controller(EvaluationController::class)->group(function() {
    Route::get('materi/ujian/{subcourse}', 'getEvaluation');
});

Route::middleware([
    EnsureFrontendRequestsAreStateful::class,'auth:sanctum',RoleCheck::class . ':Admin'
])->group(function () {
    //FOR ADMINS
});

Route::middleware([
    EnsureFrontendRequestsAreStateful::class,'auth:sanctum',RoleCheck::class . ':User,Admin'
])->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);

    Route::controller(UserController::class)->group(function() {
        Route::get('users/auth','getUser');
        Route::put('users/edit','editUser');
    });

    Route::controller(CourseController::class)->group(function() {
        Route::post('courses/enroll/{course}', 'enrollCourse');
    });

    Route::controller(EvaluationController::class)->group(function() {
       
    });
});
