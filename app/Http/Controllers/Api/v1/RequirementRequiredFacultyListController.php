<?php

// Default
// namespace App\Http\Controllers;

// For versioning modified namespace        - Always add it to new controller
namespace App\Http\Controllers\Api\v1;

// For versioning controller        - Always add it to new controller
use App\Http\Controllers\Controller;

use App\Models\RequirementRequiredFacultyList;
use Illuminate\Http\Request;

class RequirementRequiredFacultyListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Fetching w/o relationship */
        return RequirementRequiredFacultyList::all();

        // /* Fetching w/ relationship */
        // return RequirementRequiredFacultyList::with('user', 'created_by_user')->get();
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
            'requirement_bin_id' => 'required',
            'faculty_id' => 'required'
        ]);

        return RequirementRequiredFacultyList::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequirementRequiredFacultyList  $requirement_required_faculty_list
     * @return \Illuminate\Http\Response
     */
    public function show(RequirementRequiredFacultyList $requirement_required_faculty_list, $id)
    {
        //
        // return RequirementRequiredFacultyList::find($id);

        return RequirementRequiredFacultyList::with('requirement_bin', 'faculty')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RequirementRequiredFacultyList  $requirementRequiredFacultyList
     * @return \Illuminate\Http\Response
     */
    public function edit(RequirementRequiredFacultyList $requirement_required_faculty_list, $id)
    {
        // Default
        // return RequirementRequiredFacultyList::find($id);

        return RequirementRequiredFacultyList::with('user', 'created_by_user')->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RequirementRequiredFacultyList  $requirementRequiredFacultyList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequirementRequiredFacultyList $requirement_required_faculty_list, $id)
    {
        //
        $requirement_required_faculty_list = RequirementRequiredFacultyList::find($id);
        $requirement_required_faculty_list->update($request->all());

        return $requirement_required_faculty_list;
    }

    public function restore(RequirementRequiredFacultyList $requirement_required_faculty_list, $id)
    {
        //
        $requirement_required_faculty_list = RequirementRequiredFacultyList::onlyTrashed()->where('id', $id)->restore();
        return RequirementRequiredFacultyList::find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequirementRequiredFacultyList  $requirement_required_faculty_list
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequirementRequiredFacultyList $requirement_required_faculty_list, $id)
    {
        //if the model soft deleted
        $requirement_required_faculty_list = RequirementRequiredFacultyList::find($id);

        $requirement_required_faculty_list->delete();
        return $requirement_required_faculty_list;
    }

    public function show_soft_deleted($all)
    {
        $requirement_required_faculty_list = RequirementRequiredFacultyList::onlyTrashed()->get();

        return $requirement_required_faculty_list;
    }

    public function search($id)
    {
        // return RequirementRequiredFacultyList::where('id', 'like', '%'.$id.'%')->get();
        return RequirementRequiredFacultyList::where('requirement_bin_id', 'like', '%'.$id.'%')->get();
    }
}
