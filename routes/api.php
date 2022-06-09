<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// USED CONTROLLER          - ADD THE NEW CONTROLLER HERE

// API v1
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\FacultyController;
use App\Http\Controllers\Api\v1\RequirementBinController;
use App\Http\Controllers\Api\v1\RequirementTypeController;
use App\Http\Controllers\Api\v1\RequirementListTypeController;
use App\Http\Controllers\Api\v1\RequirementRequiredFacultyListController;
use App\Http\Controllers\Api\v1\SubmittedRequirementFolderController;
use App\Http\Controllers\Api\v1\SubmittedRequirementController;

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

        // Requirement Bin
        Route::get('/requirement_bin', [RequirementBinController::class, 'index']);
        Route::get('/requirement_bin/{id}', [RequirementBinController::class, 'show']);
        Route::get('/requirement_bin/search/{title}', [RequirementBinController::class, 'search']);
        Route::get('/requirement_bin/show_soft_deleted/{all}', [RequirementBinController::class, 'show_soft_deleted']);

        // Requirement Type
        Route::get('/requirement_type', [RequirementTypeController::class, 'index']);
        Route::get('/requirement_type/{id}', [RequirementTypeController::class, 'show']);
        Route::get('/requirement_type/search/{title}', [RequirementTypeController::class, 'search']);
        Route::get('/requirement_type/show_soft_deleted/{all}', [RequirementTypeController::class, 'show_soft_deleted']);

        // Requirements List Type
        Route::get('/requirement_list_type', [RequirementListTypeController::class, 'index']);
        Route::get('/requirement_list_type/{id}', [RequirementListTypeController::class, 'show']);
        Route::get('/requirement_list_type/search/{title}', [RequirementListTypeController::class, 'search']);
        Route::get('/requirement_list_type/show_soft_deleted/{all}', [RequirementListTypeController::class, 'show_soft_deleted']);

        // Requirements Required Faculty List
        Route::get('/requirement_required_faculty_list', [RequirementRequiredFacultyListController::class, 'index']);
        Route::get('/requirement_required_faculty_list/{id}', [RequirementRequiredFacultyListController::class, 'show']);
        Route::get('/requirement_required_faculty_list/search/{title}', [RequirementRequiredFacultyListController::class, 'search']);
        Route::get('/requirement_required_faculty_list/show_soft_deleted/{all}', [RequirementRequiredFacultyListController::class, 'show_soft_deleted']);

        // Submitted Requirements Folder
        Route::get('/submitted_requirement_folder', [SubmittedRequirementFolderController::class, 'index']);
        Route::get('/submitted_requirement_folder/{id}', [SubmittedRequirementFolderController::class, 'show']);
        Route::get('/submitted_requirement_folder/search/{title}', [SubmittedRequirementFolderController::class, 'search']);
        Route::get('/submitted_requirement_folder/show_soft_deleted/{all}', [SubmittedRequirementFolderController::class, 'show_soft_deleted']);

        // Submitted Requirements
        Route::get('/submitted_requirement', [SubmittedRequirementController::class, 'index']);
        Route::get('/submitted_requirement/{id}', [SubmittedRequirementController::class, 'show']);
        Route::get('/submitted_requirement/search/{title}', [SubmittedRequirementController::class, 'search']);
        Route::get('/submitted_requirement/show_soft_deleted/{all}', [SubmittedRequirementController::class, 'show_soft_deleted']);
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

        // Requirement Bin
        Route::post('/requirement_bin', [RequirementBinController::class, 'store']);
        Route::put('/requirement_bin/{id}', [RequirementBinController::class, 'update']);
        Route::delete('/requirement_bin/destroy/{id}', [RequirementBinController::class, 'destroy']);
        Route::put('/requirement_bin/restore/{id}', [RequirementBinController::class, 'restore']);

        // Requirement Type
        Route::post('/requirement_type', [RequirementTypeController::class, 'store']);
        Route::put('/requirement_type/{id}', [RequirementTypeController::class, 'update']);
        Route::delete('/requirement_type/destroy/{id}', [RequirementTypeController::class, 'destroy']);
        Route::put('/requirement_type/restore/{id}', [RequirementTypeController::class, 'restore']);

        // Requirements List Type
        Route::post('/requirement_list_type', [RequirementListTypeController::class, 'store']);
        Route::put('/requirement_list_type/{id}', [RequirementListTypeController::class, 'update']);
        Route::delete('/requirement_list_type/destroy/{id}', [RequirementListTypeController::class, 'destroy']);
        Route::put('/requirement_list_type/restore/{id}', [RequirementListTypeController::class, 'restore']);

        // Requirements Required Faculty List
        Route::post('/requirement_required_faculty_list', [RequirementRequiredFacultyListController::class, 'store']);
        Route::put('/requirement_required_faculty_list/{id}', [RequirementRequiredFacultyListController::class, 'update']);
        Route::delete('/requirement_required_faculty_list/destroy/{id}', [RequirementRequiredFacultyListController::class, 'destroy']);
        Route::put('/requirement_required_faculty_list/restore/{id}', [RequirementRequiredFacultyListController::class, 'restore']);

        // Submitted Requirements Folder
        Route::post('/submitted_requirement_folder', [SubmittedRequirementFolderController::class, 'store']);
        Route::put('/submitted_requirement_folder/{id}', [SubmittedRequirementFolderController::class, 'update']);
        Route::delete('/submitted_requirement_folder/destroy/{id}', [SubmittedRequirementFolderController::class, 'destroy']);
        Route::put('/submitted_requirement_folder/restore/{id}', [SubmittedRequirementFolderController::class, 'restore']);

        // Submitted Requirement
        Route::post('/submitted_requirement', [SubmittedRequirementController::class, 'store']);
        Route::put('/submitted_requirement/{id}', [SubmittedRequirementController::class, 'update']);
        Route::delete('/submitted_requirement/destroy/{id}', [SubmittedRequirementController::class, 'destroy']);
        Route::put('/submitted_requirement/restore/{id}', [SubmittedRequirementController::class, 'restore']);;
        });
});
