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
    return view('landing_page/index');
});

//-------------AUTH----------------//

Route::get('login', function () {
    return view('auth/login', ['page_title' => 'Login']);
})->name('login');

Route::get('logout', function () {
    return view('auth/logout', ['page_title' => 'Logout']);
})->name('logout');


//-------------ADMIN----------------//

Route::group(['middleware' => ['role.admin'],
 'prefix' => '/admin',], function(){

    // ------------DASHBOARD--------------- //
        Route::get('/dashboard', function () {
            return view('admin/dashboard/dashboard', ['page_title' => 'Dashboard']);
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

        Route::get('/user/{id}', function ($id) {
            return view('admin/profile/profile', ['page_title' => 'User Details', 'user_id' => $id]);
        })->name('admin_user_details');

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


        //REQUIREMENT LIST TYPE
        Route::get('/requirement_list_type', function () {
            return view('admin/requirement_list_type/requirement_list_type', ['page_title' => 'Requirement List Type']);
        })->name('admin_requirement_list_type');

});


//-------------FACULTY----------------//

Route::group(['middleware' => ['role.faculty'],
 'prefix' => '/faculty',], function(){

        // ------------DASHBOARD--------------- //
        Route::get('/dashboard', function () {
            return view('faculty/dashboard/dashboard', ['page_title' => 'Dashboard']);
        })->name('faculty_dashboard');

        // ------------ACCOUNT MANAGEMENT--------------- //
        Route::get('/profile/{id}', function ($id) {
            return view('faculty/profile/profile', ['page_title' => 'Profile', 'user_id' => $id]);
        })->name('faculty_profile');

        // ------------MEETING--------------- //
        Route::get('/meeting', function () {
            return view('faculty/meeting/meeting', ['page_title' => 'Meeting']);
        })->name('faculty_meeting');

        // ------------MEETING - VIEW --------------- //
        Route::get('/meeting/{id}', function ($id) {
            return view('faculty/meeting/meeting_view', ['page_title' => 'Meeting', 'meeting_id' => $id]);
        })->name('faculty_meeting_view');    

         // ------------REQUIREMENTS BIN--------------- //
        Route::get('/requirement_bin', function () {
            return view('faculty/requirement_bin/requirement_bin', ['page_title' => 'Requirements Bin']);
        })->name('faculty_requirement_bin');

        // ------------REQUIREMENTS LIST TYPE--------------- //
        Route::get('/requirement_list_type/{r_bin_id}/{rr_faculty_list_id}', function ($r_bin_id, $rr_faculty_list_id) {
            return view('faculty/requirement_list_type/requirement_list_type', ['page_title' => 'Requirements Bin', 
                                                            'requirement_bin_id' => $r_bin_id, 
                                                            'rr_faculty_list_id' => $rr_faculty_list_id]);
        })->name('faculty_requirement_list_type');

        // -------------------ACTIVITY---------------------- //
        Route::get('/activity', function () {
            return view('faculty/activity/activity', ['page_title' => 'Activity']);
        })->name('faculty_activity');

        // ------------------ACTIVITY VIEW------------------ //
        Route::get('/activity/{id}', function ($id) {
            return view('faculty/activity_view/activity_view', ['page_title' => 'Activity', 'activity_id' => $id]);
        })->name('faculty_activity_view');

        // ------------REPORTS--------------- //
            // ------------SRD REPORTS--------------- //
            Route::get('/srd_report', function () {
                return view('faculty/report/srd_report', ['page_title' => 'SRD Reports']);
            })->name('srd_report');
            // ------------MEETING REPORTS--------------- //
            Route::get('/meeting_report', function () {
                return view('faculty/report/meeting_report', ['page_title' => 'Meeting Reports']);
            })->name('meeting_report');
            // ------------ACTIVITY REPORTS--------------- //
            Route::get('/activity_report', function () {
                return view('faculty/report/activity_report', ['page_title' => 'Activity Reports']);
            })->name('activity_report');
});


//-------------ACADEMIC HEAD----------------//

Route::group(['middleware' => ['role.acadhead'],
    'prefix' => '/acad_head',], function(){

    //ACTIVITY TYPE
    Route::get('/activity_type', function () {
        return view('acad_head/activity_type/activity_type', ['page_title' => 'Activity Type']);
    })->name('acad_head_activity_type');

    //MEETING TYPE
    Route::get('/meeting_type', function () {
        return view('acad_head/meeting_type/meeting_type', ['page_title' => 'Meeting Type']);
    })->name('acad_head_meeting_type');

    //REQUIREMENT TYPE
    Route::get('/requirement_type', function () {
        return view('acad_head/requirement_type/requirement_type', ['page_title' => 'Requirement Type']);
    })->name('acad_head_requirement_type');
        
    // ------------DASHBOARD--------------- //
    Route::get('/dashboard', function () {
        return view('acad_head/dashboard/dashboard', ['page_title' => 'Dashboard']);
    })->name('acad_head_dashboard');

    Route::get('/profile/{id}', function ($id) {
        return view('acad_head/profile/profile', ['page_title' => 'Profile', 'user_id' => $id]);
    })->name('acad_head_profile');

    // ------------MEETING--------------- //
    Route::get('/meeting', function () {
        return view('acad_head/meeting/meeting', ['page_title' => 'Meeting']);
    })->name('acad_head_meeting');

        // ------------MEETING - VIEW --------------- //
        Route::get('/meeting/{id}', function ($id) {
            return view('acad_head/meeting/meeting_view', ['page_title' => 'Meeting', 'meeting_id' => $id]);
        })->name('acad_head_meeting_view');

    // ------------REQUIREMENTS BIN--------------- //
    Route::get('/requirement_bin', function () {
        return view('acad_head/requirement_bin/requirement_bin', ['page_title' => 'Requirements Bin']);
    })->name('acad_head_requirement_bin');

    // ------------REQUIREMENTS LIST TYPE--------------- //
    Route::get('/requirement_list_type/{id}', function ($id) {
        return view('acad_head/requirement_list_type/requirement_list_type', ['page_title' => 'Requirements Bin', 'requirement_bin_id' => $id]);
    })->name('acad_head_requirement_list_type');

    // -----------------ACTIVITY------------------ //
    Route::get('/activity', function () {
        return view('acad_head/activity/activity', ['page_title' => 'Activity']);
    })->name('Activity');

    // --------------ACTIVITY VIEW----------------- //
    Route::get('/activity/{id}', function ($id) {
        return view('acad_head/activity_view/activity_view', ['page_title' => 'Activity', 'activity_id'=> $id]);
    })->name('ActivityView');

    // ------------REPORTS--------------- //
        // ------------SRD REPORTS--------------- //
        Route::get('/srd_report', function () {
            return view('acad_head/report/srd_report', ['page_title' => 'SRD Reports']);
        })->name('srd_report');
        // ------------MEETING REPORTS--------------- //
        Route::get('/meeting_report', function () {
            return view('acad_head/report/meeting_report', ['page_title' => 'Meeting Reports']);
        })->name('meeting_report');
        // ------------ACTIVITY REPORTS--------------- //
        Route::get('/activity_report', function () {
            return view('acad_head/report/activity_report', ['page_title' => 'Activity Reports']);
        })->name('activity_report');

});


//-------------CHECKER----------------//

Route::group(['middleware' => ['role.checker'],
    'prefix' => '/checker',], function(){
        
    // ------------DASHBOARD--------------- //
    Route::get('/dashboard', function () {
        return view('checker/dashboard/dashboard', ['page_title' => 'Dashboard']);
    })->name('checker_dashboard');

});