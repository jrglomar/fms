<?php

// Default
// namespace App\Http\Controllers;

// For versioning modified namespace        - Always add it to new controller
namespace App\Http\Controllers\Api\v1;

// For versioning controller        - Always add it to new controller
use App\Http\Controllers\Controller;

use App\Models\MeetingAttendanceRequiredFacultyList;
use Illuminate\Http\Request;

class MeetingAttendanceRequiredFacultyListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Fetching w/o relationship */
            return MeetingAttendanceRequiredFacultyList::all();

        /* Fetching w/ relationship */
        // return MeetingAttendanceRequiredFacultyList::with('user', 'created_by_user')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $request->validate([
            'title' => 'required',
            'time_in' => 'required',
            'time_out' => 'required',
            'proof_of_attendance_file_directory' => 'required',
            'proof_of_attendance_file_link' => 'required',
            'faculty_id' => 'required',
            "meeting_id" => 'required'
        ]);

        return MeetingAttendanceRequiredFacultyList::create($request->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'time_in',
            'time_out',
            'proof_of_attendance_file_directory',
            'proof_of_attendance_file_link',
            'faculty_id' => 'required',
            "meeting_id" => 'required'
        ]);

        return MeetingAttendanceRequiredFacultyList::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MeetingAttendanceRequiredFacultyList  $meeting_attendance_required_faculty_lists
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Default
        return MeetingAttendanceRequiredFacultyList::find($id);

        // return MeetingAttendanceRequiredFacultyList::with('user', 'created_by_user')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MeetingAttendanceRequiredFacultyList  $meeting_attendance_required_faculty_lists
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Default
        return MeetingAttendanceRequiredFacultyList::find($id);

        // return MeetingAttendanceRequiredFacultyList::with('user', 'created_by_user')->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MeetingAttendanceRequiredFacultyList  $meeting_attendance_required_faculty_lists
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $meeting_attendance_required_faculty_lists = MeetingAttendanceRequiredFacultyList::find($id);
        $meeting_attendance_required_faculty_lists->update($request->all());

        return $meeting_attendance_required_faculty_lists;
    }

    public function restore(MeetingAttendanceRequiredFacultyList $meeting_attendance_required_faculty_lists, $id)
    {
        //
        $meeting_attendance_required_faculty_lists = MeetingAttendanceRequiredFacultyList::onlyTrashed()->where('id', $id)->restore();
        return MeetingAttendanceRequiredFacultyList::find($id);
    }

    public function destroy(MeetingAttendanceRequiredFacultyList $meeting_attendance_required_faculty_lists, $id)
    {
        //if the model soft deleted
        $meeting_attendance_required_faculty_lists = MeetingAttendanceRequiredFacultyList::find($id);

        $meeting_attendance_required_faculty_lists->delete();
        return $meeting_attendance_required_faculty_lists;   
    }

    public function show_soft_deleted($all)
    {
        $meeting_attendance_required_faculty_lists = MeetingAttendanceRequiredFacultyList::onlyTrashed()->get();

        return $meeting_attendance_required_faculty_lists;
    }

    public function search($meeting_id)
    {

        return MeetingAttendanceRequiredFacultyList::where('meeting_id', 'like', '%'.$meeting_id.'%')->get();
    }

    public function multi_insert(Request $request)
    {

        $data = $request->all();

        for($i=0; $i < count($data); $i++) {
            MeetingAttendanceRequiredFacultyList::create($data[$i]);
        }

        return [
            'message' => 'Multiple Insert Success.'
        ];
        
    }

    // public function get_all_faculties_per_meeting($meeting_id)
    // {
    //     $faculties_per_meeting = MeetingAttendanceRequiredFacultyList::select(
    //         "meeting_attendance_required_faculty_lists.id", 
    //         "meeting_attendance_required_faculty_lists.faculty_id",
    //         "meeting_attendance_required_faculty_lists.meeting_id"
    //     )
    //     ->where('meeting_id', $meeting_id)
    //     ->get();

    //     return $faculties_per_meeting;
    // }

    public function get_all_faculties_that_does_not_on_meeting($meeting_id)
    {
        $faculties_per_meeting = MeetingAttendanceRequiredFacultyList::select(
            "meeting_attendance_required_faculty_lists.id", 
            "meeting_attendance_required_faculty_lists.faculty_id",
            "meeting_attendance_required_faculty_lists.meeting_id"
        )
        ->where('meeting_id', "!=", $meeting_id)
        ->get();

        return $faculties_per_meeting;
    }
}
