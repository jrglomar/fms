<?php

// Default
// namespace App\Http\Controllers;

// For versioning modified namespace        - Always add it to new controller
namespace App\Http\Controllers\Api\v1;

// For versioning controller        - Always add it to new controller
use App\Http\Controllers\Controller;

use App\Models\MeetingType;
use Illuminate\Http\Request;

class MeetingTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         /* Fetching w/o relationship */
         return MeetingType::all();

         /* Fetching w/ relationship */
         // return MeetingType::with('user', 'created_by_user')->get();
     
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
            'title' => 'required|unique:meeting_types',
        ]);

        return MeetingType::create($request->all());
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
            'title' => 'required|unique:meeting_types',
        ]);

        return MeetingType::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MeetingType  $meetingType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Default
        return MeetingType::find($id);

        // return MeetingType::with('user', 'created_by_user')->find($id);
   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MeetingType  $meetingType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Default
        return MeetingType::find($id);

        // return MeetingType::with('user', 'created_by_user')->find($id);
   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MeetingType  $meetingType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $meeting_type = MeetingType::find($id);
        $meeting_type->update($request->all());

        return $meeting_type;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MeetingType  $meetingType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //if the model soft deleted
        $meeting_type = MeetingType::find($id);

        $meeting_type->delete();
        return $meeting_type;   
    }

    public function restore(MeetingType $meeting_type, $id)
    {
        //
        $meeting_type = MeetingType::onlyTrashed()->where('id', $id)->restore();
        return MeetingType::find($id);
    }

    public function show_soft_deleted($all)
    {
        $meeting_type = MeetingType::onlyTrashed()->get();

        return $meeting_type;
    }

    public function search($title)
    {

        return MeetingType::where('title', 'like', '%'.$title.'%')->get();
    }
}
