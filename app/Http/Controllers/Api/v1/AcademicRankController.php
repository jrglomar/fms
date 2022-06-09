<?php

// Default
// namespace App\Http\Controllers;

// For versioning modified namespace        - Always add it to new controller
namespace App\Http\Controllers\Api\v1;

// For versioning controller        - Always add it to new controller
use App\Http\Controllers\Controller;

use App\Models\AcademicRank;
use Illuminate\Http\Request;

class AcademicRankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Fetching w/o relationship */
        return AcademicRank::all();

        // /* Fetching w/ relationship */
        // return AcademicRank::with('user', 'created_by_user')->get();
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
        ]);

        return AcademicRank::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AcademicRank  $academicRank
     * @return \Illuminate\Http\Response
     */
    public function show(AcademicRank $academic_rank, $id)
    {
        // Default
        return AcademicRank::find($id);

        // return AcademicRank::with('user', 'created_by_user')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AcademicRank  $academicRank
     * @return \Illuminate\Http\Response
     */
    public function edit(AcademicRank $academic_rank, $id)
    {
        // Default
        // return Designation::find($id);

        return AcademicRank::with('user', 'created_by_user')->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AcademicRank  $academicRank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AcademicRank $academic_rank, $id)
    {
        //
        $academic_rank = AcademicRank::find($id);
        $academic_rank->update($request->all());

        return $academic_rank;
    }

    public function restore(AcademicRank $academic_rank, $id)
    {
        //
        $academic_rank = AcademicRank::onlyTrashed()->where('id', $id)->restore();
        return AcademicRank::find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AcademicRank  $academicRank
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcademicRank $academic_rank, $id)
    {
       //if the model soft deleted
       $academic_rank = AcademicRank::find($id);

       $academic_rank->delete();
       return $academic_rank;
    }

    public function show_soft_deleted($all)
    {
        $academic_rank = AcademicRank::onlyTrashed()->get();

        return $academic_rank;
    }

    public function search($title)
    {
        return AcademicRank::where('title', 'like', '%'.$title.'%')->get();
    }
}
