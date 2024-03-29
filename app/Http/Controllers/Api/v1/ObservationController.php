<?php

// For versioning modified namespace        - Always add it to new controller
namespace App\Http\Controllers\Api\v1;

// For versioning controller        - Always add it to new controller
use App\Http\Controllers\Controller;

use App\Models\Observation;
use Illuminate\Http\Request;

class ObservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Only active data
        // return Observation::where('active_status', 'Active')->get();

        // All data
        return Observation::all();
        
        // Return with relationships
        // return Observation::with('user', 'created_by_user')->get();
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
            'date_of_observation' => 'required|unique:observations,date_of_observation',
            'class_schedule_id' => 'required'
        ]);

        return Observation::create($request->all());
        
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
        return Observation::find($id);

        //return Observation::where('id', $id)->first();
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
        $observation = Observation::find($id);
        $observation->update($request->all());

        return $observation;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Observation $observation, $id)
    {
        //if the model soft deleted
        $observation = Observation::find($id);

        $observation->delete();
        return $observation;
    }

    public function restore(Observation $observation, $id)
    {
        //
        $observation = Observation::onlyTrashed()->where('id', $id)->restore();
        return Observation::find($id);
    }

    public function show_soft_deleted($all)
    {
        $observation = Observation::onlyTrashed()->get();

        return $observation;
    }

    public function search($title)
    {
        return Observation::where('email', 'like', '%'.$title.'%')->get();
    }

    public function get_faculty_observation($faculty_id)
    {
        $observation = Observation::select("*")
        ->where('faculty_id', $faculty_id)
        ->get();

        return $observation;
    }
}
