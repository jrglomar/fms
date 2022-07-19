<?php

// Default
// namespace App\Http\Controllers;

// For versioning modified namespace        - Always add it to new controller
namespace App\Http\Controllers\Api\v1;

// For versioning controller        - Always add it to new controller
use App\Http\Controllers\Controller;

use App\Models\FacultyType;
use Illuminate\Http\Request;

class FacultyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Fetching w/o relationship */
        return FacultyType::all();

        // /* Fetching w/ relationship */
        // return FacultyType::with('user', 'created_by_user')->get();
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
            'title' => 'required'
        ]);

        return FacultyType::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FacultyType  $faculty_type
     * @return \Illuminate\Http\Response
     */
    public function show(FacultyType $faculty_type, $id)
    {
        // Default
        return FacultyType::find($id);

        // return Requirement_bin::with('user', 'created_by_user')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FacultyType  $faculty_type
     * @return \Illuminate\Http\Response
     */
    public function edit(FacultyType $faculty_type, $id)
    {
        // Default
        // return RequirementBin::find($id);

        return FacultyType::with('user', 'created_by_user')->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FacultyType  $faculty_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FacultyType $faculty_type, $id)
    {
        //
        $faculty_type = FacultyType::find($id);
        $faculty_type->update($request->all());

        return $faculty_type;
    }

    public function restore(FacultyType $faculty_type, $id)
    {
        //
        $faculty_type = FacultyType::onlyTrashed()->where('id', $id)->restore();
        return FacultyType::find($id);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FacultyType  $facultyType
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacultyType $faculty_type, $id)
    {
        //if the model soft deleted
        $faculty_type = FacultyType::find($id);

        $faculty_type->delete();
        return $faculty_type;
    }

    public function show_soft_deleted($all)
    {
        $faculty_type = FacultyType::onlyTrashed()->get();

        return $faculty_type;
    }

    public function search($title)
    {
        return FacultyType::where('title', 'like', '%'.$title.'%')->get();
    }
}
