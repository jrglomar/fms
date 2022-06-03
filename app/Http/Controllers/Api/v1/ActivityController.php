<?php

//namespace App\Http\Controllers;

// For versioning modified namespace        - Always add it to new controller
namespace App\Http\Controllers\Api\v1;

// For versioning controller        - Always add it to new controller
use App\Http\Controllers\Controller;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
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
        return Activity::with('user', 'created_by_user')->get();
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
            'title' => 'required',
            'memorandum_file_directory' => 'required',
            'description' => 'required',
            'status' => 'required',
            'start_datetime' => 'required',
            'end_datetime' => 'required',
            'activity_type_id' => 'required'
        ]);

        return Activity::create($request->all());
        
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

        return Activity::with('user', 'created_by_user')->find($id);
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
        $activity = Activity::find($id);
        $activity->update($request->all());

        return $activity;
    }

    public function edit($id)
    {
        // Default
        // return Activity::find($id);

        return Activity::with('user', 'created_by_user')->find($id);
    }

    public function restore(Activity $activity, $id)
    {
        //
        $activity = Activity::onlyTrashed()->where('id', $id)->restore();
        return Activity::find($id);
    }

    public function destroy(Activity $activity, $id)
    {
        //if the model soft deleted
        $activity = Activity::find($id);

        $activity->delete();
        return $activity;
    }

    public function show_soft_deleted($all)
    {
        $activity = Activity::onlyTrashed()->get();

        return $activity;
    }

    public function search($title)
    {

        return Activity::where('email', 'like', '%'.$title.'%')->get();
    }
}
