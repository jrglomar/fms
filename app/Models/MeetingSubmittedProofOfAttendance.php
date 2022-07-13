<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// ADDED FOR UUID INCREMENT ERROR       - Always add it to new model
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

// ADDED FOR CREATED AND UPDATED BY AUTOMATION
use Illuminate\Support\Facades\Auth;

class MeetingSubmittedProofOfAttendance extends Model
{
    // -----  [[DEFAULT]]  -----  //
    use HasFactory, SoftDeletes;

    // [Modify this fillable base on tables]      - Can be modified
        protected $fillable = [
            "date_submitted",
            "remarks",
            "status",
            "file_name",
            "proof_of_attendance_file_link",
            "proof_of_attendance_file_directory",
            "marf_id"
        ];

        protected $dates = ['deleted_at'];


    // protected $with = ['users','created_by_user','updated_by_user'];

     // [Declare relationships here]
    public function mar_faculty_lists()
    {
        return $this->belongsTo(MeetingAttendanceRequiredFacultyList::class)->withDefault();
    }
     // End of [Declare relationships here]

    // [Default relationship]       - Default
    public function created_by_user()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function updated_by_user()
    {
        return $this->belongsTo(User::class,'updated_by');
    }

    protected $with = ['marf_faculty_lists','created_by_user','updated_by_user'];

    // [Added for UUID Incrementation]      - Default
    public $incrementing = false;

    protected $keyType = 'string';

    public static function boot(){
        parent::boot();

        static::creating(function ($issue) {
            $issue->id = Str::uuid(36);
        });

        // [Added for Automation of Created_by and Updated_by]      - Default
        static::creating(function ($model) {
            $model->created_by = is_object(Auth::guard(config('app.guards.web'))->user()) ? Auth::guard(config('app.guards.web'))->user()->id : 1;
            $model->updated_by = NULL;
        });

        static::updating(function ($model) {
            $model->updated_by = is_object(Auth::guard(config('app.guards.web'))->user()) ? Auth::guard(config('app.guards.web'))->user()->id : 1;
        });
        // END [Added for Automation of Created_by and Updated_by]      - Default
    }
    //
// -----  [[DEFAULT]]  -----  //
}