<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// USED CONTROLLER          - ADD THE NEW CONTROLLER HERE

// API v1
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\FacultyTypeController;
use App\Http\Controllers\Api\v1\DesignationController;
use App\Http\Controllers\Api\v1\AcademicRankController;
use App\Http\Controllers\Api\v1\FacultyController;
use App\Http\Controllers\Api\v1\RoleController;
use App\Http\Controllers\Api\v1\UserRoleController;
use App\Http\Controllers\Api\v1\MeetingTypeController;
use App\Http\Controllers\Api\v1\MeetingController;
use App\Http\Controllers\Api\v1\MeetingAttendanceRequiredFacultyListController;
use App\Http\Controllers\Api\v1\MeetingSubmittedProofOfAttendanceController;
use App\Http\Controllers\Api\v1\RequirementBinController;
use App\Http\Controllers\Api\v1\RequirementTypeController;
use App\Http\Controllers\Api\v1\RequirementListTypeController;
use App\Http\Controllers\Api\v1\RequirementRequiredFacultyListController;
use App\Http\Controllers\Api\v1\SubmittedRequirementFolderController;
use App\Http\Controllers\Api\v1\SubmittedRequirementController;
use App\Http\Controllers\Api\v1\ObservationController;
use App\Http\Controllers\Api\v1\ActivityTypeController;
use App\Http\Controllers\Api\v1\ActivityController;
use App\Http\Controllers\Api\v1\ActivityAttendanceRequiredFacultyListController;
use App\Http\Controllers\Api\v1\ActivityAttendanceSubmittedFileController;
use App\Http\Controllers\Api\v1\RoomController;
use App\Http\Controllers\Api\v1\ClassScheduleController;
use App\Http\Controllers\Api\v1\SpecializationController;
use App\Http\Controllers\Api\v1\ProgramController;
use App\Http\Controllers\Api\v1\FacultyEducationProfileController;
<<<<<<< HEAD
use App\Http\Controllers\Api\v1\FacultyProgramController;
=======
use App\Http\Controllers\Api\v1\ClassAttendanceController;
>>>>>>> 74849dc29cf757b62f660a270dfa9593212476b4

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
        Route::get('/user/datatable', [UserController::class, 'datatable']);
        Route::get('/user/{id}', [UserController::class, 'show']);
        Route::get('/user/search/{name}', [UserController::class, 'search']);
        Route::get('/user/show_soft_deleted/{all}', [UserController::class, 'show_soft_deleted']);
        Route::get('/user/get_faculty_for_required_list/{role_id}', [UserController::class, 'get_faculty_for_required_list']); // FOR USER CONTROLLER

        // Faculty Type
        Route::get('/faculty_type', [FacultyTypeController::class, 'index']);
        Route::get('/faculty_type/{id}', [FacultyTypeController::class, 'show']);
        Route::get('/faculty_type/search/{name}', [FacultyTypeController::class, 'search']);
        Route::get('/faculty_type/show_soft_deleted/{all}', [FacultyTypeController::class, 'show_soft_deleted']);

        // Academic Rank
        Route::get('/academic_rank', [AcademicRankController::class, 'index']);
        Route::get('/academic_rank/{id}', [AcademicRankController::class, 'show']);
        Route::get('/academic_rank/search/{name}', [AcademicRankController::class, 'search']);
        Route::get('/academic_rank/show_soft_deleted/{all}', [AcademicRankController::class, 'show_soft_deleted']);

        // Designation
        Route::get('/designation', [DesignationController::class, 'index']);
        Route::get('/designation/{id}', [DesignationController::class, 'show']);
        Route::get('/designation/search/{name}', [DesignationController::class, 'search']);
        Route::get('/designation/show_soft_deleted/{all}', [DesignationController::class, 'show_soft_deleted']);
        
        // Specialization
        Route::get('/specialization', [SpecializationController::class, 'index']);
        Route::get('/specialization/{id}', [SpecializationController::class, 'show']);
        Route::get('/specialization/search/{name}', [SpecializationController::class, 'search']);
        Route::get('/specialization/show_soft_deleted/{all}', [SpecializationController::class, 'show_soft_deleted']);

        // Program
        Route::get('/program', [ProgramController::class, 'index']);
        Route::get('/program/{id}', [ProgramController::class, 'show']);
        Route::get('/program/search/{name}', [ProgramController::class, 'search']);
        Route::get('/program/show_soft_deleted/{all}', [ProgramController::class, 'show_soft_deleted']);

        // Faculty Education Profile
        Route::get('/faculty_education_profile', [FacultyEducationProfileController::class, 'index']);
        Route::get('/faculty_education_profile/{id}', [FacultyEducationProfileController::class, 'show']);
        Route::get('/faculty_education_profile/get_all_educational_background_of_faculty/{faculty_id}', [FacultyEducationProfileController::class, 'get_all_educational_background_of_faculty']);
        Route::get('/faculty_education_profile/search/{name}', [FacultyEducationProfileController::class, 'search']);
        Route::get('/faculty_education_profile/show_soft_deleted/{all}', [FacultyEducationProfileController::class, 'show_soft_deleted']);

         // Faculty Program
         Route::get('/faculty_program', [FacultyProgramController::class, 'index']);
         Route::get('/faculty_program/{id}', [FacultyProgramController::class, 'show']);
         Route::get('/faculty_program/search/{faculty_id}', [FacultyProgramController::class, 'search']);
         Route::get('/faculty_program/search_existing/{faculty_id}/{program_id}', [FacultyProgramController::class, 'search_existing']);
         Route::get('/faculty_program/show_soft_deleted/{all}', [FacultyProgramController::class, 'show_soft_deleted']);

        // Faculty
        Route::get('/faculty', [FacultyController::class, 'index']);
        Route::get('/faculty/{id}', [FacultyController::class, 'show']);
        Route::get('/faculty/search/{name}', [FacultyController::class, 'search']);
        Route::get('/faculty/show_soft_deleted/{all}', [FacultyController::class, 'show_soft_deleted']);
        Route::get('/faculty/check_user_exist/{id}', [FacultyController::class, 'check_user_exist']);
        Route::get('/faculty/get_all_faculties_that_does_not_on_meeting/{meeting_id}', [FacultyController::class, 'get_all_faculties_that_does_not_on_meeting']); // 

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
        
        // Meeting
        Route::get('/meeting', [MeetingController::class, 'index']);
        Route::get('/meeting/{id}', [MeetingController::class, 'show']);
        Route::get('/meeting/search/{name}', [MeetingController::class, 'search']);
        Route::get('/meeting/show_soft_deleted/{all}', [MeetingController::class, 'show_soft_deleted']);
        Route::get('/meeting/get_specific_meeting_of_faculty/{faculty_id}', [MeetingController::class, 'get_specific_meeting_of_faculty']); // FOR FACULTY CONTROLLER

        // Meeting Attendance Required Faculty List
        Route::get('/meeting_attendance_required_faculty_list', [MeetingAttendanceRequiredFacultyListController::class, 'index']);
        Route::get('/meeting_attendance_required_faculty_list/{id}', [MeetingAttendanceRequiredFacultyListController::class, 'show']);
        Route::get('/meeting_attendance_required_faculty_list/search/{name}', [MeetingAttendanceRequiredFacultyListController::class, 'search']);
        Route::get('/meeting_attendance_required_faculty_list/show_soft_deleted/{all}', [MeetingAttendanceRequiredFacultyListController::class, 'show_soft_deleted']);
        Route::get('/meeting_attendance_required_faculty_list/search_specific_meeting_and_faculty/{meeting_id}/{faculty_id}', [MeetingAttendanceRequiredFacultyListController::class, 'search_specific_meeting_and_faculty']); //
        Route::get('/meeting_attendance_required_faculty_list/faculty_list_time_out_null/{meeting_id}', [MeetingAttendanceRequiredFacultyListController::class, 'faculty_list_time_out_null']); //

        // Requirement Bin
        Route::get('/requirement_bin', [RequirementBinController::class, 'index']);
        Route::get('/requirement_bin/{id}', [RequirementBinController::class, 'show']);
        Route::get('/requirement_bin/search/{title}', [RequirementBinController::class, 'search']);
        Route::get('/requirement_bin/show_soft_deleted/{all}', [RequirementBinController::class, 'show_soft_deleted']);
        Route::get('/requirement_bin/get_required_requirement_bin/{id}', [RequirementBinController::class, 'get_required_requirement_bin']); // FOR FACULTY CONTROLLER

        // Requirement Type
        Route::get('/requirement_type', [RequirementTypeController::class, 'index']);
        Route::get('/requirement_type/{id}', [RequirementTypeController::class, 'show']);
        Route::get('/requirement_type/search/{title}', [RequirementTypeController::class, 'search']);
        Route::get('/requirement_type/show_soft_deleted/{all}', [RequirementTypeController::class, 'show_soft_deleted']);

        // Requirements List Type
        Route::get('/requirement_list_type', [RequirementListTypeController::class, 'index']);
        Route::get('/requirement_list_type/{id}', [RequirementListTypeController::class, 'show']);
        Route::get('/requirement_list_type/search/{requirement_bin_id}', [RequirementListTypeController::class, 'search']);
        Route::get('/requirement_list_type/search_existing/{requirement_bin_id}/{requirement_type_id}', [RequirementListTypeController::class, 'search_existing']);
        Route::get('/requirement_list_type/show_soft_deleted/{all}', [RequirementListTypeController::class, 'show_soft_deleted']);

        // Requirements Required Faculty List
        Route::get('/requirement_required_faculty_list', [RequirementRequiredFacultyListController::class, 'index']);
        Route::get('/requirement_required_faculty_list/{id}', [RequirementRequiredFacultyListController::class, 'show']);
        Route::get('/requirement_required_faculty_list/search/{title}', [RequirementRequiredFacultyListController::class, 'search']);
        Route::get('/requirement_required_faculty_list/show_soft_deleted/{all}', [RequirementRequiredFacultyListController::class, 'show_soft_deleted']);
        Route::get('/requirement_required_faculty_list/get_unrequired_faculty/{id}', [RequirementRequiredFacultyListController::class, 'get_unrequired_faculty']);

         // Submitted Requirements
         Route::get('/meeting_submitted_proof', [MeetingSubmittedProofOfAttendanceController::class, 'index']);
         Route::get('/meeting_submitted_proof/{id}', [MeetingSubmittedProofOfAttendanceController::class, 'show']);
         Route::get('/meeting_submitted_proof/search/{title}', [MeetingSubmittedProofOfAttendanceController::class, 'search']);
         Route::get('/meeting_submitted_proof/show_soft_deleted/{all}', [MeetingSubmittedProofOfAttendanceController::class, 'show_soft_deleted']);

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

        // Observations
        Route::get('/observation', [ObservationController::class, 'index']);
        Route::get('/observation/{id}', [ObservationController::class, 'show']);
        Route::get('/observation/search/{name}', [ObservationController::class, 'search']);
        Route::get('/observation/show_soft_deleted/{all}', [ObservationController::class, 'show_soft_deleted']);
        Route::get('/observation/get_faculty_observation/{id}', [ObservationController::class, 'get_faculty_observation']); // FOR FACULTY CONTROLLER

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
        Route::get('/activity/get_required_activity/{id}', [ActivityController::class, 'get_required_activity']); // FOR FACULTY CONTROLLER

        // Activity Attendance
        Route::get('/activity_attendance', [ActivityAttendanceRequiredFacultyListController::class, 'index']);
        Route::put('/activity_attendance/time-in-out/{id}/{faculty_id}', [ActivityAttendanceRequiredFacultyListController::class, 'update']);
        Route::put('/activity_attendance/{id}', [ActivityAttendanceRequiredFacultyListController::class, 'update_status']);
        Route::get('/activity_attendance/{id}', [ActivityAttendanceRequiredFacultyListController::class, 'show']);
        Route::get('/activity_attendance/search/{id}', [ActivityAttendanceRequiredFacultyListController::class, 'search']);
        Route::get('/activity_attendance/show_soft_deleted/{all}', [ActivityAttendanceRequiredFacultyListController::class, 'show_soft_deleted']);
        Route::get('/activity_attendance/unrequired_faculty/{activity_id}', [ActivityAttendanceRequiredFacultyListController::class, 'get_unrequired_faculty']);
        Route::get('/activity_attendance/search_specific_activity_and_faculty/{activity_id}/{faculty_id}', [ActivityAttendanceRequiredFacultyListController::class, 'search_specific_activity_and_faculty']); //
        Route::get('/activity_attendance/faculty_list_time_out_null/{activity_id}', [ActivityAttendanceRequiredFacultyListController::class, 'faculty_list_time_out_null']); //
        
        // Activity Submitted Proof
        Route::get('/activity_submitted_proof', [ActivityAttendanceSubmittedFileController::class, 'index']);
         Route::get('/activity_submitted_proof/{id}', [ActivityAttendanceSubmittedFileController::class, 'show']);
         Route::get('/activity_submitted_proof/search/{title}', [ActivityAttendanceSubmittedFileController::class, 'search']);
         Route::get('/activity_submitted_proof/show_soft_deleted/{all}', [ActivityAttendanceSubmittedFileController::class, 'show_soft_deleted']);

         // Class Attendance
        Route::get('/class_attendance', [ClassAttendanceController::class, 'index']);
        Route::get('/class_attendance/{id}', [ClassAttendanceController::class, 'show']);
        Route::get('/class_attendance/show_soft_deleted/{all}', [ClassAttendanceController::class, 'show_soft_deleted']);

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

        // Faculty Type
        Route::post('/faculty_type', [FacultyTypeController::class, 'store']);
        Route::put('/faculty_type/{id}', [FacultyTypeController::class, 'update']);
        Route::delete('/faculty_type/destroy/{id}', [FacultyTypeController::class, 'destroy']);
        Route::put('/faculty_type/restore/{id}', [FacultyTypeController::class, 'restore']);

        // Academic Rank
        Route::post('/academic_rank', [AcademicRankController::class, 'store']);
        Route::put('/academic_rank/{id}', [AcademicRankController::class, 'update']);
        Route::delete('/academic_rank/destroy/{id}', [AcademicRankController::class, 'destroy']);
        Route::put('/academic_rank/restore/{id}', [AcademicRankController::class, 'restore']);

        // Designation
        Route::post('/designation', [DesignationController::class, 'store']);
        Route::put('/designation/{id}', [DesignationController::class, 'update']);
        Route::delete('/designation/destroy/{id}', [DesignationController::class, 'destroy']);
        Route::put('/designation/restore/{id}', [DesignationController::class, 'restore']);

        // Specialization
        Route::post('/specialization', [SpecializationController::class, 'store']);
        Route::put('/specialization/{id}', [SpecializationController::class, 'update']);
        Route::delete('/specialization/destroy/{id}', [SpecializationController::class, 'destroy']);
        Route::put('/specialization/restore/{id}', [SpecializationController::class, 'restore']);

        // Program
        Route::post('/program', [ProgramController::class, 'store']);
        Route::put('/program/{id}', [ProgramController::class, 'update']);
        Route::delete('/program/destroy/{id}', [ProgramController::class, 'destroy']);
        Route::put('/program/restore/{id}', [ProgramController::class, 'restore']);

        // Faculty Education Profile
        Route::post('/faculty_education_profile', [FacultyEducationProfileController::class, 'store']);
        Route::put('/faculty_education_profile/{id}', [FacultyEducationProfileController::class, 'update']);
        Route::delete('/faculty_education_profile/destroy/{id}', [FacultyEducationProfileController::class, 'destroy']);
        Route::put('/faculty_education_profile/restore/{id}', [FacultyEducationProfileController::class, 'restore']);

        // Faculty Program
        Route::post('/faculty_program', [FacultyProgramController::class, 'store']);
        Route::put('/faculty_program/{id}', [FacultyProgramController::class, 'update']);
        Route::delete('/faculty_program/destroy/{id}', [FacultyProgramController::class, 'destroy']);
        Route::put('/faculty_program/restore/{id}', [FacultyProgramController::class, 'restore']);

        // Faculty
        Route::post('/faculty', [FacultyController::class, 'store']);
        Route::put('/faculty/{id}', [FacultyController::class, 'update']);
        Route::delete('/faculty/destroy/{id}', [FacultyController::class, 'destroy']);
        Route::put('/faculty/restore/{id}', [FacultyController::class, 'restore']);
        Route::post('/faculty/faculty_image_upload', [FacultyController::class, 'faculty_image_upload']);

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
        Route::post('/user_role/multi_insert', [UserRoleController::class, 'multi_insert']);

        // Meeting Type
        Route::post('/meeting_type', [MeetingTypeController::class, 'store']);
        Route::put('/meeting_type/{id}', [MeetingTypeController::class, 'update']);
        Route::delete('/meeting_type/destroy/{id}', [MeetingTypeController::class, 'destroy']);
        Route::put('/meeting_type/restore/{id}', [MeetingTypeController::class, 'restore']);

        // Meeting
        Route::post('/meeting', [MeetingController::class, 'store']);
        Route::put('/meeting/{id}', [MeetingController::class, 'update']);
        Route::delete('/meeting/destroy/{id}', [MeetingController::class, 'destroy']);
        Route::put('/meeting/restore/{id}', [MeetingController::class, 'restore']);


        // Meeting Attendance Required Faculty List
        Route::post('/meeting_attendance_required_faculty_list', [MeetingAttendanceRequiredFacultyListController::class, 'store']);
        Route::put('/meeting_attendance_required_faculty_list/{id}', [MeetingAttendanceRequiredFacultyListController::class, 'update']);
        Route::delete('/meeting_attendance_required_faculty_list/destroy/{id}', [MeetingAttendanceRequiredFacultyListController::class, 'destroy']);
        Route::put('/meeting_attendance_required_faculty_list/restore/{id}', [MeetingAttendanceRequiredFacultyListController::class, 'restore']);
        Route::post('/meeting_attendance_required_faculty_list/multi_insert', [MeetingAttendanceRequiredFacultyListController::class, 'multi_insert']);

        // Meeting Submitted Proof
        Route::post('/meeting_submitted_proof', [MeetingSubmittedProofOfAttendanceController::class, 'store']);
        Route::put('/meeting_submitted_proof/{id}', [MeetingSubmittedProofOfAttendanceController::class, 'update']);
        Route::delete('/meeting_submitted_proof/destroy/{id}', [MeetingSubmittedProofOfAttendanceController::class, 'destroy']);
        Route::put('/meeting_submitted_proof/restore/{id}', [MeetingSubmittedProofOfAttendanceController::class, 'restore']);
        Route::post('/meeting_submitted_proof/file_uploads', [MeetingSubmittedProofOfAttendanceController::class, 'file_uploads']);
        Route::post('/meeting_submitted_proof/multi_insert', [MeetingSubmittedProofOfAttendanceController::class, 'multi_insert']);

        // Activity Submitted Proof
        Route::post('/activity_submitted_proof', [ActivityAttendanceSubmittedFileController::class, 'store']);
        Route::put('/activity_submitted_proof/{id}', [ActivityAttendanceSubmittedFileController::class, 'update']);
        Route::delete('/activity_submitted_proof/destroy/{id}', [ActivityAttendanceSubmittedFileController::class, 'destroy']);
        Route::put('/activity_submitted_proof/restore/{id}', [ActivityAttendanceSubmittedFileController::class, 'restore']);
        Route::post('/activity_submitted_proof/file_uploads', [ActivityAttendanceSubmittedFileController::class, 'file_uploads']);
        Route::post('/activity_submitted_proof/multi_insert', [ActivityAttendanceSubmittedFileController::class, 'multi_insert']);
        
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
        Route::post('/activity/upload', [ActivityController::class, 'memo_upload']);
        Route::post('/activity/replace', [ActivityController::class, 'memo_replace']);
        Route::put('/activity/{id}', [ActivityController::class, 'update']);
        Route::delete('/activity/destroy/{id}', [ActivityController::class, 'destroy']);
        Route::put('/activity/restore/{id}', [ActivityController::class, 'restore']);

        // Activity Attendance
        Route::post('/activity_attendance', [ActivityAttendanceRequiredFacultyListController::class, 'store']);
        Route::delete('/activity_attendance/destroy/{id}', [ActivityAttendanceRequiredFacultyListController::class, 'destroy']);
        Route::put('/activity_attendance/restore/{id}', [ActivityAttendanceRequiredFacultyListController::class, 'restore']);
        Route::post('/activity_attendance/multi_insert', [ActivityAttendanceRequiredFacultyListController::class, 'multi_insert']);


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
        Route::post('/requirement_required_faculty_list/multi_insert', [RequirementRequiredFacultyListController::class, 'multi_insert']);

        // Submitted Requirements Folder
        Route::post('/submitted_requirement_folder', [SubmittedRequirementFolderController::class, 'store']);
        Route::put('/submitted_requirement_folder/{id}', [SubmittedRequirementFolderController::class, 'update']);
        Route::delete('/submitted_requirement_folder/destroy/{id}', [SubmittedRequirementFolderController::class, 'destroy']);
        Route::put('/submitted_requirement_folder/restore/{id}', [SubmittedRequirementFolderController::class, 'restore']);

        // Submitted Requirement
        Route::post('/submitted_requirement', [SubmittedRequirementController::class, 'store']);
        Route::put('/submitted_requirement/{id}', [SubmittedRequirementController::class, 'update']);
        Route::delete('/submitted_requirement/destroy/{id}', [SubmittedRequirementController::class, 'destroy']);
        Route::put('/submitted_requirement/restore/{id}', [SubmittedRequirementController::class, 'restore']);
        Route::post('/submitted_requirement/file_uploads', [SubmittedRequirementController::class, 'file_uploads']);
        Route::post('/submitted_requirement/multi_insert', [SubmittedRequirementController::class, 'multi_insert']);

        // Class Attendance
        Route::post('/class_attendance', [ClassAttendanceController::class, 'store']);
        Route::put('/class_attendance/{id}', [ClassAttendanceController::class, 'update']);
        Route::delete('/class_attendance/destroy/{id}', [ClassAttendanceController::class, 'destroy']);
        Route::put('/class_attendance/restore/{id}', [ClassAttendanceController::class, 'restore']);
        Route::post('/class_attendance/file_uploads', [ClassAttendanceController::class, 'file_uploads']);
    });
});
