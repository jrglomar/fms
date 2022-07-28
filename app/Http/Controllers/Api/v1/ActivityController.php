<?php

//namespace App\Http\Controllers;

// For versioning modified namespace        - Always add it to new controller
namespace App\Http\Controllers\Api\v1;

// For versioning controller        - Always add it to new controller
use App\Http\Controllers\Controller;

use App\Models\Activity;
use Illuminate\Http\Request;
use File;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Only active data
        // return Activity::where('active_status', 'Active')->get();

        // All data
         return Activity::with('activity_type')->get();
        
        // Return with relationships
        //return Activity::with('user', 'created_by_user')->get();
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
            'status' => 'required',
            'is_required',
            'activity_type_id' => 'required'
        ]);

        
        // $file_upload = $request->'memorandum_file_directory'->store('memo');
        return Activity::create($request->all());
        // return $request->file('memorandum_file_directory')->store('memo');
    }

    public function memo_upload(Request $request)
    {
        $data = array();

        $validator = $request->validate([
            'file' => 'required|mimes:pdf,jpg,jpeg,png'
        ]);

            $data['success'] = 1;
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();

            $unique_name = md5($filename . microtime());
            $extension = $request->file('file')->extension();

            $file->move('uploads/memorandum/', $unique_name.'.'.$extension);

            $data['path'] = 'uploads/memorandum/'.$unique_name.'.'.$extension;

        return $data;
    }

    public function memo_replace(Request $request)
    {
        $data = array();

        $validator = $request->validate([
            'file' => 'required|mimes:pdf,jpg,jpeg,png'
        ]);

            $data['success'] = 1;
            $file = $request->file('file');
            $old_file = $request->input('old_file');
            $filename = $file->getClientOriginalName();

            $unique_name = md5($filename . microtime());
            $extension = $request->file('file')->extension();

            if(File::exists($old_file)){
                File::delete($old_file);
                $file->move('uploads/memorandum/', $unique_name.'.'.$extension);
                $data['path'] = 'uploads/memorandum/'.$unique_name.'.'.$extension;
                $data['message'] = "old memo deleted";
            }else{
                $data['message'] = "old memo doesnt exist";
                $data['path'] = 'uploads/memorandum/'.$unique_name.'.'.$extension;
                $file->move('uploads/memorandum/', $unique_name.'.'.$extension);
            }

        return $data;
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
         return Activity::with('activity_type', 'created_by_user')->find($id);

        //return Activity::with('user', 'created_by_user')->find($id);
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
        $activity = Activity::find($id);
        $activity->update($request->all());

        return $activity;
    }

    public function edit($id)
    {
        // Default
        return Activity::find($id);

        //return Activity::with('user', 'created_by_user')->find($id);
    }

    public function restore(Activity $activity, $id)
    {
        //
        $activity = Activity::onlyTrashed()->where('id', $id)->restore();
        return Activity::find($id);
    }

    public function destroy(Activity $activity, $id)
    {
        //if the model soft deleted
        $activity = Activity::find($id);

        $activity->delete();
        return $activity;
    }

    public function show_soft_deleted($all)
    {
        $activity = Activity::onlyTrashed()->get();

        return $activity;
    }

    public function search($title)
    {

        return Activity::where('email', 'like', '%'.$title.'%')->get();
    }

    public function get_required_activity($faculty_id)
    {
        $activities = Activity::select(
            "activities.id", 
            "activities.created_at",
            "activities.created_by",
            "activities.updated_at",
            "activities.updated_by",
            "activities.deleted_at",
            "activities.title",
            "activities.location",
            "activities.start_datetime",
            "activities.end_datetime",
            "activities.agenda",
            "activities.description",
            "activities.is_required",
            "activities.status",
            "activities.memorandum_file_directory",
            "activities.activity_type_id",
            "activity_attendance_required_faculty_lists.faculty_id as f_id" 
        )
        ->join("activity_attendance_required_faculty_lists", "activity_attendance_required_faculty_lists.activity_id", "=", "activities.id")
        ->where('faculty_id', $faculty_id)
        ->get();

        return $activities;
    }
    
    public function get_all_activities_of_specific_category($category)
    {
        $activities = Activity::select('*')
        ->join("activity_types", "activity_types.id", "=", "activities.activity_type_id")
        ->where('activity_types.category', $category)
        ->get();
        return $activities;
    }
}
