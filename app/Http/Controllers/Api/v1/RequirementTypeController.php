<?php

// Default
// namespace App\Http\Controllers;

// For versioning modified namespace        - Always add it to new controller
namespace App\Http\Controllers\Api\v1;

// For versioning controller        - Always add it to new controller
use App\Http\Controllers\Controller;

use App\Models\RequirementType;
use Illuminate\Http\Request;

class RequirementTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Fetching w/o relationship */
        return RequirementType::all();

        // /* Fetching w/ relationship */
        // return RequirementType::with('user', 'created_by_user')->get();
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
            'title' => 'required|unique:requirement_types',
        ]);

        return RequirementType::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequirementType  $requirement_type
     * @return \Illuminate\Http\Response
     */
    public function show(RequirementType $requirement_type, $id)
    {
        // Default
        return RequirementType::find($id);

        // return RequirementType::with('user', 'created_by_user')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RequirementType  $requirement_type
     * @return \Illuminate\Http\Response
     */
    public function edit(RequirementType $requirement_type, $id)
    {
        // Default
        // return RequirementType::find($id);

        return RequirementType::with('user', 'created_by_user')->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RequirementType  $requirementType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequirementType $requirement_type, $id)
    {
        //
        $requirement_type = RequirementType::find($id);
        $requirement_type->update($request->all());

        return $requirement_type;
    }

    public function restore(RequirementType $requirement_type, $id)
    {
        //
        $requirement_type = RequirementType::onlyTrashed()->where('id', $id)->restore();
        return RequirementType::find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequirementType  $requirement_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequirementType $requirement_type, $id)
    {
        //if the model soft deleted
        $requirement_type = RequirementType::find($id);

        $requirement_type->delete();
        return $requirement_type;
    }

    public function show_soft_deleted($all)
    {
        $requirement_type = RequirementType::onlyTrashed()->get();

        return $requirement_type;
    }

    public function search($title)
    {
        return RequirementType::where('title', 'like', '%'.$title.'%')->get();
    }
}
