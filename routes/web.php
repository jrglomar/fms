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

//-------------AUTH----------------//

Route::get('login', function () {
    return view('auth/login', ['page_title' => 'Login']);
})->name('login');

Route::get('logout', function () {
    return view('auth/logout', ['page_title' => 'Logout']);
})->name('logout');


//-------------ERROR----------------//

Route::get('401', function(){
    return view('error/401', ['page_title' => '401 Unauthenticated']);
})->name('401');

//-------------ADMIN----------------//

Route::group(['middleware' => ['auth']], function(){

    Route::get('admin/dashboard', function () {
        return view('admin/dashboard');
    })->name('admin_dashboard');

    Route::get('admin/user', function () {
        return view('admin/user/user', ['page_title' => 'User']);
    })->name('admin_user');

    //DESIGNATION
    Route::get('admin/designation', function () {
        return view('admin/designation/designation', ['page_title' => 'Designation']);
    })->name('admin_designation');

    //FACULTY TYPE
    Route::get('admin/faculty_type', function () {
        return view('admin/faculty_type/faculty_type', ['page_title' => 'Faculty Type']);
    })->name('admin_faculty_type');

    //ROLE
    Route::get('admin/role', function () {
        return view('admin/role/role', ['page_title' => 'Role']);
    })->name('admin_role');

    //ACADEMIC RANK
    Route::get('admin/academic_rank', function () {
        return view('admin/academic_rank/academic_rank', ['page_title' => 'Academic Rank']);
    })->name('admin_academic_rank');
});
