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


//-------------ADMIN----------------//

Route::group(['middleware' => ['auth'], 'prefix' => '/admin',], function(){

    Route::get('/dashboard', function () {
        return view('admin/dashboard');
    })->name('admin_dashboard');

    // ------------SYSTEM SETUP--------------- //
        //DESIGNATION
        Route::get('/designation', function () {
            return view('admin/designation/designation', ['page_title' => 'Designation']);
        })->name('admin_designation');

        //FACULTY TYPE
        Route::get('/faculty_type', function () {
            return view('admin/faculty_type/faculty_type', ['page_title' => 'Faculty Type']);
        })->name('admin_faculty_type');

        //ROLE
        Route::get('/role', function () {
            return view('admin/role/role', ['page_title' => 'Role']);
        })->name('admin_role');

        //ACADEMIC RANK
        Route::get('/academic_rank', function () {
            return view('admin/academic_rank/academic_rank', ['page_title' => 'Academic Rank']);
        })->name('admin_academic_rank');

    // ------------ACCOUNT MANAGEMENT--------------- //

        //USER
        Route::get('/user', function () {
            return view('admin/user/user', ['page_title' => 'User']);
        })->name('admin_user');

        //USER ROLE
        Route::get('/user_role', function () {
            return view('admin/user_role/user_role', ['page_title' => 'User Role']);
        })->name('admin_user_role');

        //DESIGNATION
        Route::get('/designation', function () {
            return view('admin/designation/designation', ['page_title' => 'Designation']);
        })->name('admin_designation');

        //FACULTY TYPE
        Route::get('/faculty_type', function () {
            return view('admin/faculty_type/faculty_type', ['page_title' => 'Faculty Type']);
        })->name('admin_faculty_type');

        //ROLE
        Route::get('/role', function () {
            return view('admin/role/role', ['page_title' => 'Role']);
        })->name('admin_role');

        //ACADEMIC RANK
        Route::get('/academic_rank', function () {
            return view('admin/academic_rank/academic_rank', ['page_title' => 'Academic Rank']);
        })->name('admin_academic_rank');

        //ACTIVITY TYPE
        Route::get('/activity_type', function () {
            return view('admin/activity_type/activity_type', ['page_title' => 'Activity Type']);
        })->name('admin_activity_type');

        //MEETING TYPE
        Route::get('/meeting_type', function () {
            return view('admin/meeting_type/meeting_type', ['page_title' => 'Meeting Type']);
        })->name('admin_meeting_type');

        //REQUIREMENT TYPE
        Route::get('/requirement_type', function () {
            return view('admin/requirement_type/requirement_type', ['page_title' => 'Requirement Type']);
        })->name('admin_requirement_type');

        //REQUIREMENT TYPE
        Route::get('/activity', function () {
            return view('admin/activity/activity', ['page_title' => 'Activity']);
        })->name('Activity');
});
