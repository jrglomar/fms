<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


//-------------ADMIN----------------//

Route::get('admin/dashboard', function () {
    return view('admin/dashboard');
});

Route::get('admin/activity', function () {
    return view('admin/activity');
});

// Sample
Route::get('admin/sample', function () {
    return view('admin/sample');
});

// ACADEMIC RANK
Route::get('admin/academic_rank', function () {
    return view('admin/academic_rank');
});

// DESIGNATION
Route::get('admin/designation', function () {
    return view('admin/designation');
});

// FACULTY TYPE
Route::get('admin/faculty_type', function () {
    return view('admin/faculty_type');
});

// ROLE
Route::get('admin/role', function () {
    return view('admin/role');
});

//----------------------------------//
