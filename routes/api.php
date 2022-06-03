<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// USED CONTROLLER          - ADD THE NEW CONTROLLER HERE

// API v1
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\FacultyController;
use App\Http\Controllers\Api\v1\ObservationController;
use App\Http\Controllers\Api\v1\ActivityTypeController;
use App\Http\Controllers\Api\v1\ActivityController;
use App\Http\Controllers\Api\v1\ActivityAttendanceRequiredFacultyListController;
use App\Http\Controllers\Api\v1\RoomController;
use App\Http\Controllers\Api\v1\ClassScheduleController;

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

        // Observations
        Route::get('/observation', [ObservationController::class, 'index']);
        Route::get('/observation/{id}', [ObservationController::class, 'show']);
        Route::get('/observation/search/{name}', [ObservationController::class, 'search']);
        Route::get('/observation/show_soft_deleted/{all}', [ObservationController::class, 'show_soft_deleted']);

        // Activity Type
        Route::get('/activity_type', [ActivityTypeController::class, 'index']);
        Route::get('/activity_type/{id}', [ActivityTypeController::class, 'show']);
        Route::get('/activity_type/search/{name}', [ActivityTypeController::class, 'search']);
        Route::get('/activity_type/show_soft_deleted/{all}', [ActivityTypeController::class, 'show_soft_deleted']);

        // Activity
        Route::get('/activity', [ActivityController::class, 'index']);
        Route::get('/activity/{id}', [ActivityController::class, 'show']);
        Route::get('/activity/search/{name}', [ActivityController::class, 'search']);
        Route::get('/activity/show_soft_deleted/{all}', [ActivityController::class, 'show_soft_deleted']);

        // Activity Attendance
        Route::get('/activity_attendance', [ActivityAttendanceRequiredFacultyListController::class, 'index']);
        Route::get('/activity_attendance/{id}', [ActivityAttendanceRequiredFacultyListController::class, 'show']);
        Route::get('/activity_attendance/search/{name}', [ActivityAttendanceRequiredFacultyListController::class, 'search']);
        Route::get('/activity_attendance/show_soft_deleted/{all}', [ActivityAttendanceRequiredFacultyListController::class, 'show_soft_deleted']);

        // Room
        Route::get('/room', [RoomController::class, 'index']);
        Route::get('/room/{id}', [RoomController::class, 'show']);
        Route::get('/room/search/{name}', [RoomController::class, 'search']);
        Route::get('/room/show_soft_deleted/{all}', [RoomController::class, 'show_soft_deleted']);

        // Class Schedule
        Route::get('/class_schedule', [ClassScheduleController::class, 'index']);
        Route::get('/class_schedule/{id}', [ClassScheduleController::class, 'show']);
        Route::get('/class_schedule/search/{name}', [ClassScheduleController::class, 'search']);
        Route::get('/class_schedule/show_soft_deleted/{all}', [ClassScheduleController::class, 'show_soft_deleted']);
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

        // Observation
        Route::post('/observation', [ObservationController::class, 'store']);
        Route::put('/observation/{id}', [ObservationController::class, 'update']);
        Route::delete('/observation/destroy/{id}', [ObservationController::class, 'destroy']);
        Route::put('/observation/restore/{id}', [ObservationController::class, 'restore']);

        // Activity Type
        Route::post('/activity_type', [ActivityTypeController::class, 'store']);
        Route::put('/activity_type/{id}', [ActivityTypeController::class, 'update']);
        Route::delete('/activity_type/destroy/{id}', [ActivityTypeController::class, 'destroy']);
        Route::put('/activity_type/restore/{id}', [ActivityTypeController::class, 'restore']);

        // Activity
        Route::post('/activity', [ActivityController::class, 'store']);
        Route::put('/activity/{id}', [ActivityController::class, 'update']);
        Route::delete('/activity/destroy/{id}', [ActivityController::class, 'destroy']);
        Route::put('/activity/restore/{id}', [ActivityController::class, 'restore']);

        // Activity Attendance
        Route::post('/activity_attendance', [ActivityAttendanceRequiredFacultyListController::class, 'store']);
        Route::put('/activity_attendance/{id}', [ActivityAttendanceRequiredFacultyListController::class, 'update']);
        Route::delete('/activity_attendance/destroy/{id}', [ActivityAttendanceRequiredFacultyListController::class, 'destroy']);
        Route::put('/activity_attendance/restore/{id}', [ActivityAttendanceRequiredFacultyListController::class, 'restore']);

        // Room
        Route::post('/room', [RoomController::class, 'store']);
        Route::put('/room/{id}', [RoomController::class, 'update']);
        Route::delete('/room/destroy/{id}', [RoomController::class, 'destroy']);
        Route::put('/room/restore/{id}', [RoomController::class, 'restore']);

        // Class Schedule
        Route::post('/class_schedule', [ClassScheduleController::class, 'store']);
        Route::put('/class_schedule/{id}', [ClassScheduleController::class, 'update']);
        Route::delete('/class_schedule/destroy/{id}', [ClassScheduleController::class, 'destroy']);
        Route::put('/class_schedule/restore/{id}', [ClassScheduleController::class, 'restore']);
    });

});
