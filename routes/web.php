<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Models\PostImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('auth.login');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('auth.login');
    Route::post('/login', 'loginStore')->name('auth.login.store');
    Route::get('/register-student', 'register')->name('auth.register.student');
    Route::get('/register-teacher', 'register')->name('auth.register.teacher');
    Route::post('/register', 'registerStore')->name('auth.register.store');
    Route::get('/logout', 'logout')->name('auth.logout');
});

Route::middleware(['auth', 'check.role:murid'])->group(function () {

    Route::controller(StudentController::class)->group(function () {
        Route::get('/dashboard-student', 'dashboard')->name('student.dashboard');
        Route::get('/lessons-subcribed', 'lessons')->name('student.lessons');
        Route::get('/lessons/{lesson:subscribe_id}', 'lesson')->name('student.lesson');
        Route::post('/join-lesson', 'joinLesson')->name('student.join-lesson');
        Route::get('/submissions', 'submissions')->name('student.submission');
        Route::post('/submissions/{post:id}', 'submitSubmission')->name('student.submit-submission');
    });
});

Route::middleware(['auth', 'check.role:pengajar'])->group(function () {

    Route::controller(TeacherController::class)->group(function () {
        Route::get('/dashboard-teacher', 'dashboard')->name('teacher.dashboard');
        Route::get('/students', 'dataStudents')->name('teacher.data-students');
        Route::post('/lessons', 'createLesson')->name('teacher.create-lesson');
        Route::get('/lessons', 'dataLessons')->name('teacher.data-lessons');
        Route::get('/data-lesson/{lesson:id}', 'detailLesson')->name('teacher.detail-lesson');
        Route::post('/posts/{lesson:id}', 'createPost')->name('teacher.create-post');
        Route::get('/submissions/post/{post:id}', 'submissions')->name('teacher.show-submission');
        Route::post('/upload-image/{post:id}','uploadImages')->name('teacher.upload.image.activity');
    });
});


Route::get('/{any}', function(){
    return redirect()->route('auth.login');
})->where('any', '.*');
