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
<<<<<<< HEAD
        return ActivityAttendanceRequiredFacultyListController::with('user', 'created_by_user')->get();
=======
       // return ActivityType::with('user', 'created_by_user')->get();
>>>>>>> a9cdf25104474df1460563c2568a03697f35d72a
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

<<<<<<< HEAD
        return ActivityAttendanceRequiredFacultyListController::with('user', 'created_by_user')->find($id);
=======
        //return ActivityType::with('user', 'created_by_user')->find($id);
>>>>>>> a9cdf25104474df1460563c2568a03697f35d72a
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
<<<<<<< HEAD
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
=======
        return ActivityType::find($id);

        //return ActivityType::with('user', 'created_by_user')->find($id);
    }

    public function restore(ActivityAttendanceRequiredFacultyList $activity_type, $id)
    {
        //
        $activity_type = ActivityAttendanceRequiredFacultyList::onlyTrashed()->where('id', $id)->restore();
        return ActivityAttendanceRequiredFacultyList::find($id);
    }

    public function destroy(ActivityAttendanceRequiredFacultyList $activity_type, $id)
    {
        //if the model soft deleted
        $activity_type = ActivityAttendanceRequiredFacultyList::find($id);
>>>>>>> a9cdf25104474df1460563c2568a03697f35d72a

        $ActivityAttendance->delete();
        return $ActivityAttendance;
    }

    public function show_soft_deleted($all)
    {
<<<<<<< HEAD
        $ActivityAttendance = ActivityAttendanceRequiredFacultyListController::onlyTrashed()->get();
=======
        $activity_type = ActivityAttendanceRequiredFacultyList::onlyTrashed()->get();
>>>>>>> a9cdf25104474df1460563c2568a03697f35d72a

        return $ActivityAttendance;
    }

    public function search($title)
    {

<<<<<<< HEAD
        return ActivityAttendanceRequiredFacultyListController::where('email', 'like', '%'.$title.'%')->get();
=======
        return ActivityAttendanceRequiredFacultyList::where('email', 'like', '%'.$title.'%')->get();
>>>>>>> a9cdf25104474df1460563c2568a03697f35d72a
    }
}
