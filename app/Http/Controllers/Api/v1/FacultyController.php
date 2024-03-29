<?php


// Default
// namespace App\Http\Controllers;

// For versioning modified namespace        - Always add it to new controller
namespace App\Http\Controllers\Api\v1;

// For versioning controller        - Always add it to new controller
use App\Http\Controllers\Controller;

use App\Models\Faculty;
use App\Models\MeetingAttendanceRequiredFacultyList;
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
            return Faculty::with('user', 'designation', 'designation.created_by_user', 'faculty_type', 'academic_rank', 'created_by_user', 'updated_by_user')->get();
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
            // 'salutation' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'birthdate' => 'required',
            // 'birthplace' => 'required',
            'hire_date' => 'required',
            // 'phone_number' => 'required',
            // 'province' => 'required',
            // 'city' => 'required',
            // 'barangay' => 'required',
            // 'street' => 'required',
            'house_number' => 'required',
            'user_id' => 'required',
            'academic_rank_id' => 'required',
            'faculty_type_id' => 'required',
            'designation_id' => 'required',
            'specialization_id' => 'required',
        ]);

        return Faculty::create($request->all());
    }

    public function faculty_image_upload(Request $request){
        $data = array();

        $validator = $request->validate([
            'file' => 'required|mimes:gif,svg,jpg,jpeg,png|max:2048'
        ]);

            $data['success'] = 1;
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();

            $unique_name = md5($filename . microtime());
            $extension = $request->file('file')->extension();

            $file->move('images/faculty_images/', $unique_name.'.'.$extension);

            $data['path'] = 'images/faculty_images/'.$unique_name.'.'.$extension;

        return $data;
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

    
    public function check_user_exist($id)
    {
        $faculties = Faculty::all();

        $users = array();

        foreach($faculties as $faculty){
            array_push($users, $faculty->user->id);
        }

        if (in_array($id, $users)){
            return True;
        }
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

    public function get_all_faculties_that_does_not_on_meeting($meeting_id)
    {
        $faculties_per_meeting = Faculty::select("*")
        ->whereNotIn('faculties.id', MeetingAttendanceRequiredFacultyList::select("meeting_attendance_required_faculty_lists.faculty_id")
        ->rightJoin('faculties', 'faculties.id', '=', 'meeting_attendance_required_faculty_lists.faculty_id')
        ->where('meeting_attendance_required_faculty_lists.meeting_id', $meeting_id))
        ->get();

        return $faculties_per_meeting;
    }
    
}
