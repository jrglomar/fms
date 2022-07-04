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
        // return ActivityAttendanceRequiredFacultyList::where('active_status', 'Active')->get();

        // All data
        return ActivityAttendanceRequiredFacultyList::all();

        // Return with relationships
        //return ActivityAttendanceRequiredFacultyList::with('user', 'created_by_user')->get();
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
        return ActivityAttendanceRequiredFacultyList::find($id);

        return ActivityAttendanceRequiredFacultyList::with('user', 'created_by_user')->find($id);
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
        $ActivityAttendanceRequiredFacultyList = ActivityAttendanceRequiredFacultyList::find($id);
        $ActivityAttendanceRequiredFacultyList->update($request->all());

        return $ActivityAttendanceRequiredFacultyList;
    }

    public function edit($id)
    {
        // Default
        // return ActivityAttendanceRequiredFacultyList::find($id);

        return ActivityAttendanceRequiredFacultyList::with('user', 'created_by_user')->find($id);
    }

    public function restore(ActivityAttendanceRequiredFacultyList $ActivityAttendance, $id)
    {
        //
        $ActivityAttendance = ActivityAttendanceRequiredFacultyList::onlyTrashed()->where('id', $id)->restore();
        return ActivityAttendanceRequiredFacultyList::find($id);
    }

    public function destroy(ActivityAttendanceRequiredFacultyList $ActivityAttendance, $id)
    {
        //if the model soft deleted
        $ActivityAttendance = ActivityAttendanceRequiredFacultyList::find($id);

        $ActivityAttendance->delete();
        return $ActivityAttendance;
    }

    public function show_soft_deleted($all)
    {
        $ActivityAttendance = ActivityAttendanceRequiredFacultyList::onlyTrashed()->get();

        return $ActivityAttendance;
    }

    public function search($id)
    {

        return ActivityAttendanceRequiredFacultyList::where('activity_id', 'like', '%'.$id.'%')->get();
    }

    public function multi_insert(Request $request)
    {

        $data = $request->all();

        for($i=0; $i < count($data); $i++) {
            ActivityAttendanceRequiredFacultyList::create($data[$i]);
        }

        return [
            'message' => 'Multiple Insert Success.'
        ];
        
    }
}
