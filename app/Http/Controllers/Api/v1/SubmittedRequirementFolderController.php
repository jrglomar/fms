<?php

// Default
// namespace App\Http\Controllers;

// For versioning modified namespace        - Always add it to new controller
namespace App\Http\Controllers\Api\v1;

// For versioning controller        - Always add it to new controller
use App\Http\Controllers\Controller;

use App\Models\SubmittedRequirementFolder;
use Illuminate\Http\Request;

class SubmittedRequirementFolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Fetching w/o relationship */
        return SubmittedRequirementFolder::all();

        // /* Fetching w/ relationship */
        // return SubmittedRequirementFolder::with('user', 'created_by_user')->get();
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
            'remarks' => 'required',
            'requirement_bin_id' => 'required',
            'faculty_id' => 'required'
        ]);

        return SubmittedRequirementFolder::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubmittedRequirementFolder  $submittedRequirementFolder
     * @return \Illuminate\Http\Response
     */
    public function show(SubmittedRequirementFolder $submitted_requirement_folder, $id)
    {
        // Default
        //  return SubmittedRequirementFolder::find($id);

        return SubmittedRequirementFolder::with('faculty', 'requirement_bin')->find($id);
  
        // return SubmittedRequirementFolder::with('user', 'created_by_user')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubmittedRequirementFolder  $submittedRequirementFolder
     * @return \Illuminate\Http\Response
     */
    public function edit(SubmittedRequirementFolder $submitted_requirement_folder, $id)
    {
        // Default
        // return SubmittedRequirementFolder::find($id);

        return SubmittedRequirementFolder::with('user', 'created_by_user')->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubmittedRequirementFolder  $submittedRequirementFolder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubmittedRequirementFolder $submitted_requirement_folder, $id)
    {
        //
        $submitted_requirement_folder = SubmittedRequirementFolder::find($id);
        $submitted_requirement_folder->update($request->all());

        return $submitted_requirement_folder;
    }

    public function restore(SubmittedRequirementFolder $submitted_requirement_folder, $id)
    {
        //
        $submitted_requirement_folder = SubmittedRequirementFolder::onlyTrashed()->where('id', $id)->restore();
        return SubmittedRequirementFolder::find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubmittedRequirementFolder  $submittedRequirementFolder
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubmittedRequirementFolder $submitted_requirement_folder, $id)
    {
        //if the model soft deleted
        $submitted_requirement_folder = SubmittedRequirementFolder::find($id);

        $submitted_requirement_folder->delete();
        return $submitted_requirement_folder;
    }

    public function show_soft_deleted($all)
    {
        $submitted_requirement_folder = SubmittedRequirementFolder::onlyTrashed()->get();

        return $submitted_requirement_folder;
    }

    public function search($id)
    {
        return SubmittedRequirementFolder::where('id', 'like', '%'.$id.'%')->get();
    }
}
