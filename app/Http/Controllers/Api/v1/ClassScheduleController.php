<?php

//namespace App\Http\Controllers;
// For versioning modified namespace        - Always add it to new controller
namespace App\Http\Controllers\Api\v1;

use App\Models\ClassSchedule;
use Illuminate\Http\Request;

// For versioning controller        - Always add it to new controller
use App\Http\Controllers\Controller;

class ClassScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Only active data
        // return ClassSchedule::where('active_status', 'Active')->get();

        // All data
        return ClassSchedule::all();
        
        // Return with relationships
            
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
            'room_id' => 'required',
            'subject_offering_id' => 'required',
            'code' => 'required',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required'
        ]);

        return ClassSchedule::create($request->all());
        
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
        return ClassSchedule::find($id);

       // return ClassSchedule::with('user', 'created_by_user')->find($id);
    }

    public function edit($id)
    {
        // Default
        // return ClassSchedule::find($id);

        return ClassSchedule::with('user', 'created_by_user')->find($id);
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
        $ClassSchedule = ClassSchedule::find($id);
        $ClassSchedule->update($request->all());

        return $ClassSchedule;
    }
    
    public function restore(ClassSchedule $ClassSchedule, $id)
    {
        //
        $ClassSchedule = ClassSchedule::onlyTrashed()->where('id', $id)->restore();
        return ClassSchedule::find($id);
    }

    public function destroy(ClassSchedule $ClassSchedule, $id)
    {
        //if the model soft deleted
        $ClassSchedule = ClassSchedule::find($id);

        $ClassSchedule->delete();
        return $ClassSchedule;
    }

    public function show_soft_deleted($all)
    {
        $ClassSchedule = ClassSchedule::onlyTrashed()->get();

        return $ClassSchedule;
    }

    public function search($title)
    {

        return ClassSchedule::where('email', 'like', '%'.$title.'%')->get();
    }
    //
}
