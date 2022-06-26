<?php

// Default
// namespace App\Http\Controllers;

// For versioning modified namespace        - Always add it to new controller
namespace App\Http\Controllers\Api\v1;

// For versioning controller        - Always add it to new controller
use App\Http\Controllers\Controller;

use App\Models\RequirementListType;
use Illuminate\Http\Request;

class RequirementListTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Fetching w/o relationship */
        // return RequirementListType::all();

        // /* Fetching w/ relationship */
        return RequirementListType::with('requirement_bin', 'requirement_type')->get();
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
            'requirement_bin_id' => 'required',
            'requirement_type_id' => 'required',
        ]);

        return RequirementListType::create($request->all());
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
            'requirement_type_id' => 'required'
        ]);

        return RequirementListType::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequirementListType  $requirementListType
     * @return \Illuminate\Http\Response
     */
    public function show(RequirementListType $requirement_list_type, $id)
    {
        // Default
        // return RequirementListType::find($id);

        return RequirementListType::with('requirement_bin', 'requirement_type')->find($id);

        // return RequirementListType::with('user', 'created_by_user')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RequirementListType  $requirementListType
     * @return \Illuminate\Http\Response
     */
    public function edit(RequirementListType $requirement_list_type, $id)
    {
        // Default
        // return RequirementListType::find($id);

        return RequirementListType::with('user', 'created_by_user')->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RequirementListType  $requirementListType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequirementListType $requirement_list_type, $id)
    {
        //
        $requirement_list_type = RequirementListType::find($id);
        $requirement_list_type->update($request->all());

        return $requirement_list_type;
    }

    public function restore(RequirementListType $requirement_list_type, $id)
    {
        //
        $requirement_list_type = RequirementListType::onlyTrashed()->where('id', $id)->restore();
        return RequirementListType::find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequirementListType  $requirementListType
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequirementListType $requirement_list_type, $id)
    {
        //if the model soft deleted
        $requirement_list_type = RequirementListType::find($id);

        $requirement_list_type->delete();
        return $requirement_list_type;
    }

    public function show_soft_deleted($all)
    {
        $requirement_list_type = RequirementListType::onlyTrashed()->get();

        return $requirement_list_type;
    }

    public function search($requirement_bin_id)
    {
        return RequirementListType::where('requirement_bin_id', 'like', '%'.$requirement_bin_id.'%')->get();
    }

    public function search_existing($requirement_bin_id, $requirement_type_id)
    {
        return RequirementListType::where('requirement_bin_id', $requirement_bin_id)->where('requirement_type_id', $requirement_type_id)->get();
    }
}
