<?php

// Default
// namespace App\Http\Controllers;

// For versioning modified namespace        - Always add it to new controller
namespace App\Http\Controllers\Api\v1;

// For versioning controller        - Always add it to new controller
use App\Http\Controllers\Controller;

use App\Models\RequirementBin;
use Illuminate\Http\Request;

class RequirementBinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Fetching w/o relationship */
        return RequirementBin::all();

        // /* Fetching w/ relationship */
        // return RequirementBin::with('user', 'created_by_user')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'description' => 'required',
            'deadline' => 'required'
        ]);

        return RequirementBin::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequirementBin  $Requirement_bin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Default
        return RequirementBin::find($id);

        // return Requirement_bin::with('user', 'created_by_user')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RequirementBin  $requirement_bin
     * @return \Illuminate\Http\Response
     */
    public function edit(RequirementBin $requirement_bin, $id)
    {
        // Default
        // return RequirementBin::find($id);

        return RequirementBin::with('user', 'created_by_user')->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RequirementBin  $Requirement_bin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequirementBin $requirement_bin, $id)
    {
        //
        $requirements_bin = RequirementBin::find($id);
        $requirements_bin->update($request->all());

        return $requirements_bin;
    }

    public function restore(RequirementBin $requirement_bin, $id)
    {
        //
        $requirement_bin = RequirementBin::onlyTrashed()->where('id', $id)->restore();
        return RequirementBin::find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequirementBin  $Requirement_bin
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequirementBin $requirement_bin, $id)
    {
        //if the model soft deleted
        $requirement_bin = RequirementBin::find($id);

        $requirement_bin->delete();
        return $requirement_bin;
    }

    public function show_soft_deleted($all)
    {
        $requirement_bin = RequirementBin::onlyTrashed()->get();

        return $requirement_bin;
    }

    public function search($title)
    {
        return RequirementBin::where('title', 'like', '%'.$title.'%')->get();
    }
}
