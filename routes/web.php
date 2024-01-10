<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [StudentController::class, 'index'])->name('student.index');
Route::get('/create', [StudentController::class, 'create'])->name('student.create');
Route::post('/create', [StudentController::class, 'store'])->name('student.store');




/**
 * Controllers Routing
 */
//Route::controller(CourseController::class)->group(function () {
//    Route::get('courses', 'index')->name('course.index');
//    Route::get('courses/create', 'create')->name('course.create');
//    Route::post('courses/create', 'store')->name('course.store');
//});
/**
 * Route Prefixes
 */

//Route::prefix('courses')->group(function () {
//    Route::get('/', [CourseController::class, 'index'])->name('course.index');
//    Route::get('/create', [CourseController::class, 'create'])->name('course.create');
//    Route::post('/create', [CourseController::class, 'store'])->name('course.store');
//});

/**
 * Route Name Prefixes
 */
Route::name('course.')->group(function () {
    Route::get('courses', [CourseController::class, 'index'])->name('index');
    Route::get('courses/create', [CourseController::class, 'create'])->name('create');
    Route::post('courses/create', [CourseController::class, 'store'])->name('store');
    Route::delete('courses/{course}', [CourseController::class, 'destroy'])->name('destroy');
});
