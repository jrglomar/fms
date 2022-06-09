<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// USED CONTROLLER          - ADD THE NEW CONTROLLER HERE

// API v1
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\FacultyController;
use App\Http\Controllers\Api\v1\RoleController;
use App\Http\Controllers\Api\v1\UserRoleController;
use App\Http\Controllers\Api\v1\MeetingTypeController;
use App\Http\Controllers\Api\v1\MeetingController;
use App\Http\Controllers\Api\v1\MeetingAttendanceRequiredFacultyListController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// ------------------------------------------ [[PUBLIC ROUTES]] ------------------------------------------ // 
    Route::group(['prefix' => '/v1', 'namespace' => 'Api\v1'], function(){

        // Auth
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);

        // User
        Route::get('/user', [UserController::class, 'index']);
        Route::get('/user/{id}', [UserController::class, 'show']);
        Route::get('/user/search/{name}', [UserController::class, 'search']);
        Route::get('/user/show_soft_deleted/{all}', [UserController::class, 'show_soft_deleted']);

        // Faculty
        Route::get('/faculty', [FacultyController::class, 'index']);
        Route::get('/faculty/{id}', [FacultyController::class, 'show']);
        Route::get('/faculty/search/{name}', [FacultyController::class, 'search']);
        Route::get('/faculty/show_soft_deleted/{all}', [FacultyController::class, 'show_soft_deleted']);

        // Role
        Route::get('/role', [RoleController::class, 'index']);
        Route::get('/role/{id}', [RoleController::class, 'show']);
        Route::get('/role/search/{name}', [RoleController::class, 'search']);
        Route::get('/role/show_soft_deleted/{all}', [RoleController::class, 'show_soft_deleted']);
        
        // User Role
        Route::get('/user_role', [UserRoleController::class, 'index']);
        Route::get('/user_role/{id}', [UserRoleController::class, 'show']);
        Route::get('/user_role/search/{name}', [UserRoleController::class, 'search']);
        Route::get('/user_role/show_soft_deleted/{all}', [UserRoleController::class, 'show_soft_deleted']);
        
        // Meeting Types
        Route::get('/meeting_type', [MeetingTypeController::class, 'index']);
        Route::get('/meeting_type/{id}', [MeetingTypeController::class, 'show']);
        Route::get('/meeting_type/search/{name}', [MeetingTypeController::class, 'search']);
        Route::get('/meeting_type/show_soft_deleted/{all}', [MeetingTypeController::class, 'show_soft_deleted']);
        
        // Meeting Types
        Route::get('/meeting', [MeetingController::class, 'index']);
        Route::get('/meeting/{id}', [MeetingController::class, 'show']);
        Route::get('/meeting/search/{name}', [MeetingController::class, 'search']);
        Route::get('/meeting/show_soft_deleted/{all}', [MeetingController::class, 'show_soft_deleted']);

        // Meeting Attendance Required Faculty List
        Route::get('/meeting_attendance_required_faculty_list', [MeetingAttendanceRequiredFacultyListController::class, 'index']);
        Route::get('/meeting_attendance_required_faculty_list/{id}', [MeetingAttendanceRequiredFacultyListController::class, 'show']);
        Route::get('/meeting_attendance_required_faculty_list/search/{name}', [MeetingAttendanceRequiredFacultyListController::class, 'search']);
        Route::get('/meeting_attendance_required_faculty_list/show_soft_deleted/{all}', [MeetingAttendanceRequiredFacultyListController::class, 'show_soft_deleted']);

    });


// ------------------------------------------ [[PRIVATE ROUTES]] ------------------------------------------ // 
Route::group(['middleware' => ['auth:sanctum']], function(){

    Route::group(['prefix' => '/v1', 'namespace' => 'Api\v1'], function(){
        // Auth
        Route::post('/logout', [AuthController::class, 'logout']);

        // User
        // Route::post('/user', [UserController::class, 'store']);
        Route::put('/user/{id}', [UserController::class, 'update']);
        Route::delete('/user/destroy/{id}', [UserController::class, 'destroy']);
        Route::put('/user/restore/{id}', [UserController::class, 'restore']);

        // Faculty
        Route::post('/faculty', [FacultyController::class, 'store']);
        Route::put('/faculty/{id}', [FacultyController::class, 'update']);
        Route::delete('/faculty/destroy/{id}', [FacultyController::class, 'destroy']);
        Route::put('/faculty/restore/{id}', [FacultyController::class, 'restore']);

        // Role
        Route::post('/role', [RoleController::class, 'store']);
        Route::put('/role/{id}', [RoleController::class, 'update']);
        Route::delete('/role/destroy/{id}', [RoleController::class, 'destroy']);
        Route::put('/role/restore/{id}', [RoleController::class, 'restore']);

        // User Role
        Route::post('/user_role', [UserRoleController::class, 'store']);
        Route::put('/user_role/{id}', [UserRoleController::class, 'update']);
        Route::delete('/user_role/destroy/{id}', [UserRoleController::class, 'destroy']);
        Route::put('/user_role/restore/{id}', [UserRoleController::class, 'restore']);

        // Meeting
        Route::post('/meeting', [MeetingController::class, 'store']);
        Route::put('/meeting/{id}', [MeetingController::class, 'update']);
        Route::delete('/meeting/destroy/{id}', [MeetingController::class, 'destroy']);
        Route::put('/meeting/restore/{id}', [MeetingController::class, 'restore']);

        // Meeting Type
        Route::post('/meeting_type', [MeetingController::class, 'store']);
        Route::put('/meeting_type/{id}', [MeetingController::class, 'update']);
        Route::delete('/meeting_type/destroy/{id}', [MeetingController::class, 'destroy']);
        Route::put('/meeting_type/restore/{id}', [MeetingController::class, 'restore']);

        // Meeting Attendance Required Faculty List
        Route::post('/meeting_attendance_required_faculty_list', [MeetingAttendanceRequiredFacultyListController::class, 'store']);
        Route::put('/meeting_attendance_required_faculty_list/{id}', [MeetingAttendanceRequiredFacultyListController::class, 'update']);
        Route::delete('/meeting_attendance_required_faculty_list/destroy/{id}', [MeetingAttendanceRequiredFacultyListController::class, 'destroy']);
        Route::put('/meeting_attendance_required_faculty_list/restore/{id}', [MeetingAttendanceRequiredFacultyListController::class, 'restore']);
        
    });

});
