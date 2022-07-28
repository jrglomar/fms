<?php

//namespace App\Http\Controllers;
// For versioning modified namespace        - Always add it to new controller
namespace App\Http\Controllers\Api\v1;

use App\Models\ClassAttendance;

use Illuminate\Http\Request;

// For versioning controller        - Always add it to new controller
use App\Http\Controllers\Controller;

class ClassAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ClassAttendance::all();
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
            'class_schedule_id' => 'required',
            'date_of_class' => 'required',
            'faculty_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'proof_of_attendance_file' => 'required'
        ]);

        
        return ClassAttendance::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        return ClassAttendance::find($id);
    }

    public function show_specific_class($id)
    {
        //

        return ClassAttendance::select("*")
                ->where('class_schedule_id', $id)
                ->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $ClassAttendance = ClassAttendance::find($id);
        $ClassAttendance->update($request->all());

        return $ClassAttendance;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    public function restore(ClassAttendance $ClassAttendance, $id)
    {
        //
        $ClassAttendance = ClassAttendance::onlyTrashed()->where('id', $id)->restore();
        return ClassAttendance::find($id);
    }

    public function destroy(ClassAttendance $ClassAttendance, $id)
    {
        //if the model soft deleted
        $ClassAttendance = ClassAttendance::find($id);

        $ClassAttendance->delete();
        return $ClassAttendance;
    }

    public function show_soft_deleted($all)
    {
        $ClassAttendance = ClassAttendance::onlyTrashed()->get();

        return $ClassAttendance;
    }

    public function file_uploads(Request $request){

        $validator = $request->validate([
            'file' => 'required|mimes:gif,jpg,jpeg,png'
        ]);

            $file = $request->file('file');
            $filename = $file->getClientOriginalName();

            $without_extension = pathinfo($filename, PATHINFO_FILENAME);
            $unique_name = md5($without_extension . microtime());

            $extension = $request->file('file')->extension();

            $file->move('uploads/class_proof_of_attendance/', $unique_name.'.'.$extension);

            $data = 'uploads/class_proof_of_attendance/'.$unique_name.'.'.$extension;

        return $data;
    }

}
