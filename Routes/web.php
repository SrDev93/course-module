<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function() {
    Route::resource('CourseCategory', 'CourseCategoryController');
    Route::post('CourseCategory-sort', 'CourseCategoryController@sort_item')->name('CourseCategory-sort');

    Route::resource('course', 'CourseController');
});

