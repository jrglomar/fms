<?php

// Default
// namespace App\Http\Controllers;

// For versioning modified namespace        - Always add it to new controller
namespace App\Http\Controllers\Api\v1;

// For versioning controller        - Always add it to new controller
use App\Http\Controllers\Controller;

use App\Models\Specialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Fetching w/o relationship */
        return Specialization::all();

        // /* Fetching w/ relationship */
        // return Designation::with('user', 'created_by_user')->get();
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
            'title' => 'required|unique:designations,deleted_at',
        ]);

        return Specialization::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Specialization  $specialization
     * @return \Illuminate\Http\Response
     */
    public function show(Specialization $specialization, $id)
    {
        // Default
        return Specialization::find($id);

        // return Designation::with('user', 'created_by_user')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Specialization  $specialization
     * @return \Illuminate\Http\Response
     */
    public function edit(Specialization $specialization, $id)
    {
        // Default
        // return Designation::find($id);

        return Specialization::with('user', 'created_by_user')->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Specialization  $specialization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Specialization $specialization, $id)
    {
        //
        $specialization = Specialization::find($id);
        $specialization->update($request->all());

        return $specialization;
    }

    public function restore(Specialization $specialization, $id)
    {
        //
        $specialization = Specialization::onlyTrashed()->where('id', $id)->restore();
        return Specialization::find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Specialization  $specialization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specialization $specialization, $id)
    {
        //if the model soft deleted
        $specialization = Specialization::find($id);

        $specialization->delete();
        return $specialization;
    }

    public function show_soft_deleted($all)
    {
        $specialization = Specialization::onlyTrashed()->get();

        return $specialization;
    }

    public function search($title)
    {
        return Specialization::where('title', 'like', '%'.$title.'%')->get();
    }
}
