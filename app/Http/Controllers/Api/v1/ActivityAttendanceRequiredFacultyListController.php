<?php

//namespace App\Http\Controllers;

// For versioning modified namespace        - Always add it to new controller
namespace App\Http\Controllers\Api\v1;

// For versioning controller        - Always add it to new controller
use App\Http\Controllers\Controller;

use App\Models\ActivityAttendanceRequiredFacultyList;
use Illuminate\Http\Request;

class ActivityAttendanceRequiredFacultyListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Only active data
        // return FacultyUserRole::where('active_status', 'Active')->get();

        // All data
        // return FacultyUserRole::all();
        
        // Return with relationships
        return ActivityAttendanceRequiredFacultyListController::with('user', 'created_by_user')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'time_in' => 'required',
            'time_out' => 'required',
            'attendance_status' => 'required',
            'proof_of_attendance_file_directory' => 'required',
            'proof_of_attendance_file_link' => 'required',
            'end_datetime' => 'required',
            'activity_id' => 'required',
            'faculty_id' => 'required'
        ]);

        return ActivityAttendanceRequiredFacultyList::create($request->all());
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // return FacultyUserRole::find($id);

        return ActivityAttendanceRequiredFacultyListController::with('user', 'created_by_user')->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $ActivityAttendance = ActivityAttendanceRequiredFacultyList::find($id);
        $ActivityAttendance->update($request->all());

        return $ActivityAttendance;
    }

    public function edit($id)
    {
        // Default
        // return ActivityAttendanceRequiredFacultyListController::find($id);

        return ActivityAttendanceRequiredFacultyListController::with('user', 'created_by_user')->find($id);
    }

    public function restore(ActivityAttendanceRequiredFacultyListController $ActivityAttendance, $id)
    {
        //
        $ActivityAttendance = ActivityAttendanceRequiredFacultyListController::onlyTrashed()->where('id', $id)->restore();
        return ActivityAttendanceRequiredFacultyListController::find($id);
    }

    public function destroy(ActivityAttendanceRequiredFacultyListController $ActivityAttendance, $id)
    {
        //if the model soft deleted
        $ActivityAttendance = ActivityAttendanceRequiredFacultyListController::find($id);

        $ActivityAttendance->delete();
        return $ActivityAttendance;
    }

    public function show_soft_deleted($all)
    {
        $ActivityAttendance = ActivityAttendanceRequiredFacultyListController::onlyTrashed()->get();

        return $ActivityAttendance;
    }

    public function search($title)
    {

        return ActivityAttendanceRequiredFacultyListController::where('email', 'like', '%'.$title.'%')->get();
    }
}
