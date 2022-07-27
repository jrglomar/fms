<?php

// Default
// namespace App\Http\Controllers;

// For versioning modified namespace        - Always add it to new controller
namespace App\Http\Controllers\Api\v1;

// For versioning controller        - Always add it to new controller
use App\Http\Controllers\Controller;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Fetching w/o relationship */
        return Program::all();

        // /* Fetching w/ relationship */
        // return Program::with('user', 'created_by_user')->get();
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
            'title' => 'required|unique:programs,title,NULL,id,deleted_at,NULL'
        ]);

        return Program::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program, $id)
    {
        // Default
        return Program::find($id);

        // return Designation::with('user', 'created_by_user')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program, $id)
    {
        // Default
        // return Designation::find($id);

        return Program::with('user', 'created_by_user')->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program, $id)
    {
        //
        $program = Program::find($id);
        $program->update($request->all());

        return $program;
    }

    public function restore(Program $program, $id)
    {
        //
        $program = Program::onlyTrashed()->where('id', $id)->restore();
        return Program::find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program, $id)
    {
        //if the model soft deleted
        $program = Program::find($id);

        $program->delete();
        return $program;
    }

    public function show_soft_deleted($all)
    {
        $program = Program::onlyTrashed()->get();

        return $program;
    }

    public function search($title)
    {
        return Program::where('title', 'like', '%'.$title.'%')->get();
    }
}
