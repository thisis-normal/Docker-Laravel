<?php

use App\Http\Controllers\StudentAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::get('/student-index', [StudentAPIController::class, 'index'])->name('student-api.index');
//view detail of 1 student
Route::get('/student-index/{id}', [StudentAPIController::class, 'show'])->name('student-api.show');
//update 1 student
Route::post('/student-create', [StudentAPIController::class, 'store'])->name('student-api.store');
Route::put('/student-index/{id}', [StudentAPIController::class, 'update'])->name('student-api.update');
Route::delete('/student/{id}', [StudentAPIController::class, 'destroy'])->name('student-api.destroy');
