<?php

// Default
// namespace App\Http\Controllers;

// For versioning modified namespace        - Always add it to new controller
namespace App\Http\Controllers\Api\v1;

// For versioning controller        - Always add it to new controller
use App\Http\Controllers\Controller;

use App\Models\Meeting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // /* Fetching w/o relationship */
        // return Meeting::all();

        /* Fetching w/ relationship */
        return Meeting::with('meeting_type')->get();
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
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'required',
            'meeting_types_id' => 'required',
        ]);

        return Meeting::create($request->all());
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
            'title' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'required',
            'meeting_types_id' => 'required',
        ]);

        return Meeting::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Default
        return Meeting::find($id);

        // return Meeting::with('meeting_type')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Default
        return Meeting::find($id);

        // return Meeting::with('user', 'created_by_user')->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $meeting = Meeting::find($id);
        $meeting->update($request->all());

        return $meeting;
    }

    public function restore(Meeting $meeting, $id)
    {
        //
        $meeting = Meeting::onlyTrashed()->where('id', $id)->restore();
        return Meeting::find($id);
    }

    public function destroy(Meeting $meeting, $id)
    {
        //if the model soft deleted
        $meeting = Meeting::find($id);

        $meeting->delete();
        return $meeting;   
    }

    public function show_soft_deleted($all)
    {
        $meeting = Meeting::onlyTrashed()->get();

        return $meeting;
    }

    public function search($title)
    {

        return Meeting::where('title', 'like', '%'.$title.'%')->get();
    }

// ---------------------------------------------- FACULTY CONTROLLER ---------------------------------------------- //
    public function get_specific_meeting_of_faculty($faculty_id)
    {
        $meetings = Meeting::select(
            // "meetings.id", 
            // "meetings.created_at",
            // "meetings.created_by",
            // "meetings.updated_at",
            // "meetings.updated_by",
            // "meetings.deleted_at",
            // "meetings.title",
            // "meetings.location",
            // "meetings.date",
            // "meetings.start_time",
            // "meetings.end_time",
            // "meetings.agenda",
            // "meetings.description",
            // "meetings.is_required",
            // "meetings.status",
            // "meetings.meeting_types_id",
            // "meeting_attendance_required_faculty_lists.faculty_id as f_id" 
        )
        ->join("meeting_attendance_required_faculty_lists", "meeting_attendance_required_faculty_lists.meeting_id", "=", "meetings.id")
        ->where('faculty_id', $faculty_id)
        ->get();

        return $meetings;
    }

    
}
