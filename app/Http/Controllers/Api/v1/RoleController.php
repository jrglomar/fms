<?php

// Default
// namespace App\Http\Controllers;

// For versioning modified namespace        - Always add it to new controller
namespace App\Http\Controllers\Api\v1;

// For versioning controller        - Always add it to new controller
use App\Http\Controllers\Controller;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Fetching w/o relationship */
            return Role::all();

        /* Fetching w/ relationship */
        // return Role::with('user', 'created_by_user')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $request->validate([
            'title' => 'required',
        ]);

        return Role::create($request->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:roles,title,NULL,id,deleted_at,NULL'
        ]);

        return Role::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Default
        return Role::find($id);

        // return Role::with('user', 'created_by_user')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Default
        return Role::find($id);

        // return Role::with('user', 'created_by_user')->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $role = Role::find($id);
        $role->update($request->all());

        return $role;
    }

    public function restore(Role $role, $id)
    {
        //
        $role = Role::onlyTrashed()->where('id', $id)->restore();
        return Role::find($id);
    }

    public function destroy(Role $role, $id)
    {
        //if the model soft deleted
        $role = Role::find($id);

        $role->delete();
        return $role;   
    }

    public function show_soft_deleted($all)
    {
        $role = Role::onlyTrashed()->get();

        return $role;
    }

    public function search($title)
    {

        return Role::where('title', 'like', '%'.$title.'%')->get();
    }

}
