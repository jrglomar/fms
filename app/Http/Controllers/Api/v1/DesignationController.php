<?php

// Default
// namespace App\Http\Controllers;

// For versioning modified namespace        - Always add it to new controller
namespace App\Http\Controllers\Api\v1;

// For versioning controller        - Always add it to new controller
use App\Http\Controllers\Controller;

use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Fetching w/o relationship */
        return Designation::all();

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
            'title' => 'required',
        ]);

        return Designation::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function show(Designation $designation, $id)
    {
        // Default
        return Designation::find($id);

        // return Designation::with('user', 'created_by_user')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function edit(Designation $designation, $id)
    {
        // Default
        // return Designation::find($id);

        return Designation::with('user', 'created_by_user')->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Designation $designation, $id)
    {
        //
        $designation = Designation::find($id);
        $designation->update($request->all());

        return $designation;
    }

    public function restore(Designation $designation, $id)
    {
        //
        $designation = Designation::onlyTrashed()->where('id', $id)->restore();
        return Designation::find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Designation $designation, $id)
    {
        //if the model soft deleted
        $designation = Designation::find($id);

        $designation->delete();
        return $designation;
    }

    public function show_soft_deleted($all)
    {
        $designation = Designation::onlyTrashed()->get();

        return $designation;
    }

    public function search($title)
    {
        return Designation::where('title', 'like', '%'.$title.'%')->get();
    }
}
