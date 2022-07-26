<?php

// Default
// namespace App\Http\Controllers;

// For versioning modified namespace        - Always add it to new controller
namespace App\Http\Controllers\Api\v1;

// For versioning controller        - Always add it to new controller
use App\Http\Controllers\Controller;

use App\Models\FacultyEducationProfile;
use Illuminate\Http\Request;

class FacultyEducationProfileController extends Controller
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
        return FacultyEducationProfile::with('faculty', 'created_by_user', 'updated_by_user')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $request->validate([
            'degree' => 'required',
            'program' => 'required',
            'school',
            'year_of_attendance',
            'faculty_id' => 'required',
        ]);

        return FacultyEducationProfile::create($request->all());
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
            'degree' => 'required',
            'program' => 'required',
            'school',
            'year_of_attendance',
            'faculty_id' => 'required',
        ]);

        return FacultyEducationProfile::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FacultyEducationProfile  $facultyEducationProfile
     * @return \Illuminate\Http\Response
     */
    public function show(FacultyEducationProfile $facultyEducationProfile, $id)
    {
        // Default
        // return Faculty::find($id);

        return FacultyEducationProfile::with('faculty', 'created_by_user')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FacultyEducationProfile  $facultyEducationProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(FacultyEducationProfile $facultyEducationProfile, $id)
    {
        // Default
        // return Faculty::find($id);

        return FacultyEducationProfile::with('user', 'created_by_user')->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FacultyEducationProfile  $facultyEducationProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FacultyEducationProfile $facultyEducationProfile, $id)
    {
        //

        $facultyEducationProfile = FacultyEducationProfile::find($id);
        $facultyEducationProfile->update($request->all());

        return $facultyEducationProfile;
    }

    public function restore(FacultyEducationProfile $facultyEducationProfile, $id)
    {
        //
        $facultyEducationProfile = FacultyEducationProfile::onlyTrashed()->where('id', $id)->restore();
        return FacultyEducationProfile::find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FacultyEducationProfile  $facultyEducationProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacultyEducationProfile $facultyEducationProfile, $id)
    {
        //if the model soft deleted
        $facultyEducationProfile = FacultyEducationProfile::find($id);

        $facultyEducationProfile->delete();
        return $facultyEducationProfile;
    }

    public function get_all_educational_background_of_faculty(FacultyEducationProfile $facultyEducationProfile, $faculty_id)
    {
        $facultyEducationProfile = FacultyEducationProfile::select('*')
        ->where('faculty_id', $faculty_id)
        ->orderBy('created_at')
        ->get();

        return $facultyEducationProfile;
    }
}
