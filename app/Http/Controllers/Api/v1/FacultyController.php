<?php


// Default
// namespace App\Http\Controllers;

// For versioning modified namespace        - Always add it to new controller
namespace App\Http\Controllers\Api\v1;

// For versioning controller        - Always add it to new controller
use App\Http\Controllers\Controller;

use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        /* Fetching w/o relationship */
            // return User::all();

        /* Fetching w/ relationship */
            return Faculty::with('user', 'created_by_user')->get();
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
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_number' => 'required',
            'user_id' => 'required',
        ]);

        return Faculty::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Default
        // return Faculty::find($id);

        return Faculty::with('user', 'created_by_user')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Default
        // return Faculty::find($id);

        return Faculty::with('user', 'created_by_user')->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $faculty = Faculty::find($id);
        $faculty->update($request->all());

        return $faculty;
    }

    public function restore(Faculty $faculty, $id)
    {
        //
        $faculty = Faculty::onlyTrashed()->where('id', $id)->restore();
        return Faculty::find($id);
    }

    public function destroy(Faculty $faculty, $id)
    {
        //if the model soft deleted
        $faculty = Faculty::find($id);

        $faculty->delete();
        return $faculty;
    }

    public function show_soft_deleted($all)
    {
        $faculty = Faculty::onlyTrashed()->get();

        return $faculty;
    }

    public function search($title)
    {

        return Faculty::where('email', 'like', '%'.$title.'%')->get();
    }

    
}
