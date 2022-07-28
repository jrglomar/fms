<?php

// Default
// namespace App\Http\Controllers;

// For versioning modified namespace        - Always add it to new controller
namespace App\Http\Controllers\Api\v1;

// For versioning controller        - Always add it to new controller
use App\Http\Controllers\Controller;

use App\Models\FacultyProgram;
use Illuminate\Http\Request;

class FacultyProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return FacultyProgram::with('faculty', 'program')->get();
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
            'faculty_id' => 'required',
            'program_id' => 'required',
        ]);
        return FacultyProgram::create($request->all());
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
            'faculty_id' => 'required',
            'program_id' => 'required'
        ]);

        return FacultyProgram::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FacultyProgram  $facultyProgram
     * @return \Illuminate\Http\Response
     */
    public function show(FacultyProgram $facultyProgram, $id)
    {
        //
        return FacultyProgram::with('faculty', 'program')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FacultyProgram  $facultyProgram
     * @return \Illuminate\Http\Response
     */
    public function edit(FacultyProgram $facultyProgram, $id)
    {
        //
        return FacultyProgram::with('user', 'created_by_user')->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FacultyProgram  $facultyProgram
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FacultyProgram $facultyProgram, $id)
    {
        //
        $facultyProgram = FacultyProgram::find($id);
        $facultyProgram->update($request->all());

        return $facultyProgram;
    }

    public function restore(FacultyProgram $facultyProgram, $id)
    {
        //
        $facultyProgram = FacultyProgram::onlyTrashed()->where('id', $id)->restore();
        return FacultyProgram::find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FacultyProgram  $facultyProgram
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacultyProgram $facultyProgram, $id)
    {
        //if the model soft deleted
        $facultyProgram = FacultyProgram::find($id);

        $facultyProgram->delete();
        return $facultyProgram;
    }

    public function show_soft_deleted($all)
    {
        $facultyProgram = FacultyProgram::onlyTrashed()->get();

        return $facultyProgram;
    }

    public function search($faculty_id)
    {
        return FacultyProgram::where('faculty_id', 'like', '%'.$faculty_id.'%')->get();
    }

    public function search_existing($faculty_id, $program_id)
    {
        return FacultyProgram::where('faculty_id', $faculty_id)->where('program_id', $program_id)->get();
    }
}
