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
        /* Fetching w/o relationship */
            return Meeting::all();

        /* Fetching w/ relationship */
        // return Meeting::with('user', 'created_by_user')->get();
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

        // return Meeting::with('user', 'created_by_user')->find($id);
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

}
