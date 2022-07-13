<?php

// Default
// namespace App\Http\Controllers;

// For versioning modified namespace        - Always add it to new controller
namespace App\Http\Controllers\Api\v1;

// For versioning controller        - Always add it to new controller
use App\Http\Controllers\Controller;

use App\Models\MeetingSubmittedProofOfAttendance;
use Illuminate\Http\Request;

class MeetingSubmittedProofOfAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Fetching w/o relationship */
        return MeetingSubmittedProofOfAttendance::all();
        // /* Fetching w/ relationship */
        // return SubmittedRequirement::with('user', 'created_by_user')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $request->validate([
        'file_name' => 'required',
        'proof_of_attendance_file_directory' => 'required',
        'proof_of_attendance_file_link' => 'required',
        'marf_id' => 'required',
        ]);
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
            'file_name' => 'required',
            'proof_of_attendance_file_directory',
            'proof_of_attendance_file_link',
            'marf_id' => 'required',
        ]);
    }

    public function file_uploads(Request $request)
    {

        $validator = $request->validate([
            'file' => 'required|mimes:pdf,jpg,jpeg,png'
        ]);

            $file = $request->file('file');
            $filename = $file->getClientOriginalName();

            $without_extension = pathinfo($filename, PATHINFO_FILENAME);
            $unique_name = md5($without_extension . microtime());

            $extension = $request->file('file')->extension();

            $file->move('uploads/meeting_proof_of_attendance/', $unique_name.'.'.$extension);

            $data = 'uploads/meeting_proof_of_attendance/'.$unique_name.'.'.$extension;

        return $data;
    }

    public function multi_insert(Request $request)
    {

        $data = $request->all();

        for($i=0; $i < count($data); $i++) {
            MeetingSubmittedProofOfAttendance::create($data[$i]);
        }

        return [
            'status' => 'success'
        ];

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MeetingSubmittedProofOfAttendance  $meetingSubmittedProofOfAttendance
     * @return \Illuminate\Http\Response
     */
    public function show(MeetingSubmittedProofOfAttendance $meeting_submitted_proof_of_attendance, $id)
    {
        return MeetingSubmittedProofOfAttendance::with('mar_faculty_lists')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MeetingSubmittedProofOfAttendance  $meetingSubmittedProofOfAttendance
     * @return \Illuminate\Http\Response
     */
    public function edit(MeetingSubmittedProofOfAttendance $meeting_submitted_proof_of_attendance, $id)
    {
        return MeetingSubmittedProofOfAttendance::with('user', 'created_by_user')->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MeetingSubmittedProofOfAttendance  $meetingSubmittedProofOfAttendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MeetingSubmittedProofOfAttendance $meeting_submitted_proof_of_attendance, $id)
    {
        //
        $meeting_submitted_proof_of_attendance = MeetingSubmittedProofOfAttendance::find($id);
        $meeting_submitted_proof_of_attendance->update($request->all());
        return $meeting_submitted_proof_of_attendance;
    }

    public function restore(MeetingSubmittedProofOfAttendance $meeting_submitted_proof_of_attendance, $id)
    {
        //
        $meeting_submitted_proof_of_attendance = MeetingSubmittedProofOfAttendance::onlyTrashed()->where('id', $id)->restore();
        return MeetingSubmittedProofOfAttendance::find($id);
    }

    public function show_soft_deleted($all)
    {
        $meeting_submitted_proof_of_attendance = MeetingSubmittedProofOfAttendance::onlyTrashed()->get();
        return $meeting_submitted_proof_of_attendance;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MeetingSubmittedProofOfAttendance  $meetingSubmittedProofOfAttendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(MeetingSubmittedProofOfAttendance $meeting_submitted_proof_of_attendance, $id)
    {
        //if the model soft deleted
        $meeting_submitted_proof_of_attendance = MeetingSubmittedProofOfAttendance::find($id);

        $meeting_submitted_proof_of_attendance->delete();
        return $meeting_submitted_proof_of_attendance;   
    }

    public function search($id)
    {
        return MeetingSubmittedProofOfAttendance::where('id', 'like', '%'.$id.'%')->get();
    }
}
