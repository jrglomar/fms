<?php

// Default
// namespace App\Http\Controllers;

// For versioning modified namespace        - Always add it to new controller
namespace App\Http\Controllers\Api\v1;

// For versioning controller        - Always add it to new controller
use App\Http\Controllers\Controller;

use App\Models\UserRole;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Fetching w/o relationship */
        // return UserRole::all();

        /* Fetching w/ relationship */
        return UserRole::with('user', 'role')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $request->validate([
            'user_id' => 'required',
            'role_id' => 'required',
        ]);

        return UserRole::create($request->all());
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
            'user_id' => 'required',
            'role_id' => 'required',
        ]);

        return UserRole::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserRole  $userRole
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Default
        // return UserRole::find($id);

        return UserRole::with('user', 'role')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserRole  $userRole
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Default
        // return UserRole::find($id);

        return UserRole::with('user', 'role')->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserRole  $userRole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $user_role = UserRole::find($id);
        $user_role->update($request->all());

        return $user_role;
    }

    public function restore(UserRole $user_role, $id)
    {
        //
        $role = UserRole::onlyTrashed()->where('id', $id)->restore();
        return UserRole::find($id);
    }

    public function destroy(UserRole $user_role, $id)
    {
        //if the model soft deleted
        $user_role = UserRole::find($id);

        $user_role->delete();
        return $user_role;
    }

    public function show_soft_deleted($all)
    {
        $user_role = UserRole::onlyTrashed()->get();

        return $user_role;
    }

    public function search($title)
    {

        return UserRole::where('title', 'like', '%'.$title.'%')->get();
    }
}
