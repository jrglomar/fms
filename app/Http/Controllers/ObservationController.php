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
        // return FacultyUserRole::where('active_status', 'Active')->get();

        // All data
        // return FacultyUserRole::all();
        
        // Return with relationships
        return Observation::where('active_status', 'Active')->get();
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
            'proof_of_observation_file_directory' => 'required',
            'proof_of_observation_file_link' => 'required',
            'remarks' => 'required',
            'date_of_observation' => 'required',
            'schedule_id' => 'required'
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
        // return FacultyUserRole::find($id);

        return Observation::where('id', $id)->first();
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
    public function deactivate(Request $request, $id)
    {
        //
        $observation = Observation::find($id);
        $observation->update(array('active_status' => 'Inactive'));

        return $observation;
    }
}
