<?php

// Default
// namespace App\Http\Controllers;

// For versioning modified namespace        - Always add it to new controller
namespace App\Http\Controllers\Api\v1;

// For versioning controller        - Always add it to new controller
use App\Http\Controllers\Controller;

use App\Models\SubmittedRequirement;
use Illuminate\Http\Request;

class SubmittedRequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Fetching w/o relationship */
        return SubmittedRequirement::all();

        // /* Fetching w/ relationship */
        // return SubmittedRequirement::with('user', 'created_by_user')->get();
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
            'file_name' => 'required',
            'file_link_directory' => 'required',
            'submitted_requirement_folder_id' => 'required',
        ]);

        return SubmittedRequirement::create($request->all());
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubmittedRequirement  $submittedRequirement
     * @return \Illuminate\Http\Response
     */
    public function show(SubmittedRequirement $submitted_requirement, $id)
    {
        // Default
        // return SubmittedRequirement::find($id);

        return SubmittedRequirement::with('submitted_requirement_folder')->find($id);
        
        // return SubmittedRequirement::with('user', 'created_by_user')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubmittedRequirement  $submittedRequirement
     * @return \Illuminate\Http\Response
     */
    public function edit(SubmittedRequirement $submitted_requirement, $id)
    {
        // Default
        // return SubmittedRequirement::find($id);

        return SubmittedRequirement::with('user', 'created_by_user')->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubmittedRequirement  $submittedRequirement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubmittedRequirement $submittedRequirement, $id)
    {
        //
        $submitted_requirement = SubmittedRequirement::find($id);
        $submitted_requirement->update($request->all());

        return $submitted_requirement;
    }

    public function restore(SubmittedRequirement $submitted_requirement, $id)
    {
        //
        $submitted_requirement = SubmittedRequirement::onlyTrashed()->where('id', $id)->restore();
        return SubmittedRequirement::find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubmittedRequirement  $submittedRequirement
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubmittedRequirement $submitted_requirement, $id)
    {
        //if the model soft deleted
        $submitted_requirement = SubmittedRequirement::find($id);

        $submitted_requirement->delete();
        return $submitted_requirement;
    }
    
    public function show_soft_deleted($all)
    {
        $submitted_requirement = SubmittedRequirement::onlyTrashed()->get();

        return $submitted_requirement;
    }

    public function search($id)
    {
        return SubmittedRequirement::where('id', 'like', '%'.$id.'%')->get();
    }

    
    public function file_uploads(Request $request){

        $validator = $request->validate([
            'file' => 'required|mimes:pdf,docx,jpg,jpeg,png'
        ]);

            $file = $request->file('file');
            $filename = $file->getClientOriginalName();

            $without_extension = pathinfo($filename, PATHINFO_FILENAME);
            $unique_name = md5($without_extension . microtime());

            $extension = $request->file('file')->extension();

            $file->move('uploads/submission_bin/', $unique_name.'.'.$extension);

            $data = 'uploads/submission_bin/'.$unique_name.'.'.$extension;

        return $data;
    }

    public function multi_insert(Request $request)
    {

        $data = $request->all();

        for($i=0; $i < count($data); $i++) {
            SubmittedRequirement::create($data[$i]);
        }

        return [
            'status' => 'success'
        ];
        
    }
}
