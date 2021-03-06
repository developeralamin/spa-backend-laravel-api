<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\BennarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//        return $request->user();
// });



Route::middleware('auth:sanctum')->group(function(){

Route::get('/category',[CategoryController::class,'index']);
Route::post('/category',[CategoryController::class,'create']);
Route::get('/category/{id}',[CategoryController::class,'edit']);
Route::put('/category/{id}',[CategoryController::class,'update']);
Route::delete('/category/{id}',[CategoryController::class,'destroy']);

// lesson api section
Route::get('/lessons',[LessonController::class,'index']);
Route::post('/lessons',[LessonController::class,'create']);
Route::get('/lessons/{id}',[LessonController::class,'edit']);
Route::put('/lessons/{id}',[LessonController::class,'update']);
Route::delete('/lessons/{id}',[LessonController::class,'destroy']);
Route::get('/lessons/{id}',[LessonController::class,'show']);

// bennar api section
Route::get('/bennar',[BennarController::class,'index']);
Route::post('/bennar',[BennarController::class,'create']);
Route::get('/bennar/{id}',[BennarController::class,'edit']);
Route::post('/bennar/{id}',[BennarController::class,'update']);
Route::delete('/bennar/{id}',[BennarController::class,'destroy']);

// course api section
Route::get('/courses',[CourseController::class,'index']);
Route::post('/courses',[CourseController::class,'create']);
Route::get('/courses/{id}',[CourseController::class,'edit']);
Route::post('/courses/{id}',[CourseController::class,'update']);
Route::delete('/courses/{id}',[CourseController::class,'destroy']);

// about api section
Route::get('/about',[AboutController::class,'index']);
Route::post('/about',[AboutController::class,'create']);
Route::get('/about/{id}',[AboutController::class,'edit']);
Route::post('/about/{id}',[AboutController::class,'update']);
Route::delete('/about/{id}',[AboutController::class,'destroy']);
Route::get('/about/{id}',[AboutController::class,'show']);



});



Route::get('/getAllcourses',[CourseController::class,'index']);
Route::get('/courses/{id}',[CourseController::class,'show']);
Route::post('/login_user',[UserController::class,'login']);
Route::post('/sign_up',[UserController::class,'sign_up']);
