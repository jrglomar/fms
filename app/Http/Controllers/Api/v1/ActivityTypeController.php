<?php

//namespace App\Http\Controllers;

// For versioning modified namespace        - Always add it to new controller
namespace App\Http\Controllers\Api\v1;

// For versioning controller        - Always add it to new controller
use App\Http\Controllers\Controller;

use App\Models\ActivityType;
use Illuminate\Http\Request;

class ActivityTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Only active data
        // return ActivityType::where('active_status', 'Active')->get();

        // All data
         return ActivityType::all();
        
        // Return with relationships
        //return ActivityType::with('user', 'created_by_user')->get();
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
            'title' => 'required'
        ]);

        return ActivityType::create($request->all());
        
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
         return ActivityType::find($id);

        //return ActivityType::with('user', 'created_by_user')->find($id);
    }

    public function edit($id)
    {
        // Default
        // return ActivityType::find($id);

        return ActivityType::with('user', 'created_by_user')->find($id);
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
        $activity_type = ActivityType::find($id);
        $activity_type->update($request->all());

        return $activity_type;
    }
    
    public function restore(ActivityType $activity_type, $id)
    {
        //
        $activity_type = ActivityType::onlyTrashed()->where('id', $id)->restore();
        return ActivityType::find($id);
    }

    public function destroy(ActivityType $activity_type, $id)
    {
        //if the model soft deleted
        $activity_type = ActivityType::find($id);

        $activity_type->delete();
        return $activity_type;
    }

    public function show_soft_deleted($all)
    {
        $activity_type = ActivityType::onlyTrashed()->get();

        return $activity_type;
    }

    public function search($title)
    {

        return ActivityType::where('email', 'like', '%'.$title.'%')->get();
    }
    //
}
