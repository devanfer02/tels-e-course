<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SubCourseController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;

// Maintanence
// Route::get('/', [PageController::class, 'redirect'])->name('redirect');

Route::controller(PageController::class)->group(function() {
    Route::get('/', 'home')->name('home');
    Route::get('/login', 'userLogin')->name('guest.login');
    Route::get('/register', 'userRegister')->name('guest.register');
    Route::get('/auth/login', 'login');
    Route::fallback('notfound');
});

Route::controller(AuthController::class)->group(function() {
    Route::post('/register', 'webRegister')->name('guest.web-register');
    Route::post('/login', 'webLogin')->name('guest.web-login');
    Route::delete('/logout', 'webLogout')->name('user.web-logout');
    Route::post('/auth/login', 'adminLogin')->name('login');
});

Route::controller(CourseController::class)->group(function() {
    Route::get('/course/{course}', 'showUser')->name('guest.show-mapel');
    Route::post('/course/enroll/{course}', 'webEnrollCourse')->name('user.enroll');
});

Route::controller(SubCourseController::class)->group(function() {
    Route::get('/course/{course}/sub/{subCourse}', 'showUser')->name('guest.show-materi');
});

Route::middleware('mpsbauth:User,Admin')->group(function() {
    Route::controller(PageController::class)->group(function() {
        Route::get('/courses/my', 'myCourse')->name('user.courses');
    });

    Route::controller(EvaluationController::class)->group(function() {
        Route::get('/quiz/{evaluation}', 'showUser')->name('user.show-exam');
        Route::get('/quiz/show/result/{subcourse}', 'viewResult')->name('quiz.result');
        Route::post('/quiz/submit/{subcourse}', 'submit')->name('submit.quiz');
    });

    Route::controller(QuestionController::class)->group(function() {
        Route::get('/quiz/{evaluation}/question/{index}', 'showUser')->name('user.show-question');
    });

    Route::controller(UserController::class)->group(function() {
        Route::get('/users/profile', 'profile')->name('user.profile');
        Route::put('/users/profile/{user}', 'update')->name('user.profile.update');
    });
});

Route::middleware('mpsbauth:Admin')->group(function() {
    Route::controller(PageController::class)->group(function() {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/pengguna', 'users')->name('pengguna');
        Route::get('/record', 'records')->name('record');
        Route::get('/mata-pelajaran', 'courses')->name('mata-pelajaran');
        Route::get('/mata-pelajaran/tambah', 'createCourse')->name('tambah-mapel');
        Route::get('/mata-pelajaran/{course}/materi/tambah', 'createSubcourse')->name('tambah-materi');
        Route::get('/ujian', 'exams')->name('ujian');
        Route::get('/enrolls', 'enrolls')->name('enrolls');
        Route::get('/back', 'back')->name('back');
    });

    Route::controller(CourseController::class)->group(function() {
        Route::get('/mata-pelajaran/{course}', 'show')->name('show-mapel');
        Route::get('/mata-pelajaran/edit/{course}', 'edit')->name('edit-mapel');
        Route::post('/mata-pelajaran', 'store')->name('add-mapel');
        Route::put('/mata-pelajaran/{course}', 'update')->name('update-mapel');
        Route::delete('/mata-pelajaran/{course}', 'destroy')->name('delete-mapel');
    });

    Route::controller(SubCourseController::class)->group(function() {
        Route::get('/mata-pelajaran/{course}/materi/{subCourse}', 'show')->name('show-materi');
        Route::get('/mata-pelajaran/{course}/materi/edit/{subCourse}', 'edit')->name('edit-materi');
        Route::post('/mata-pelajaran/{course}/materi', 'store')->name('add-materi');
        Route::put('/mata-pelajaran/materi/{subCourse}', 'update')->name('update-materi');
        Route::delete('/mata-pelajaran/{course}/materi/{subCourse}', 'destroy')->name('delete-materi');
    });

    Route::controller(EvaluationController::class)->group(function() {
        Route::get('/ujian/show/{evaluation}', 'show')->name('show-ujian');
        Route::get('/ujian/edit/{evaluation}', 'edit')->name('edit-ujian');
        Route::get('/ujian/create', 'create')->name('create-ujian');
        Route::get('/ujian/make', 'make')->name('make-ujian');
        Route::post('/ujian/create', 'store')->name('add-ujian');
        Route::put('/ujian/update/{evaluation}', 'update')->name('update-evaluation');
        Route::delete('/ujian/{evaluation}', 'destroy')->name('delete-ujian');
    });

    Route::controller(QuestionController::class)->group(function() {
        Route::put('/pertanyaan/{question}', 'update')->name('update-question');
    });

    Route::delete('/auth/logout', [AuthController::class, 'adminLogout'])->name('logout');
});
