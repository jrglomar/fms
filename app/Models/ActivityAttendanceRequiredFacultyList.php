<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// ADDED FOR UUID INCREMENT ERROR       - Always add it to new model
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

// ADDED FOR CREATED AND UPDATED BY AUTOMATION
use Illuminate\Support\Facades\Auth;

class ActivityAttendanceRequiredFacultyList extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "time_in",
        "time_out",
        "attendance_status",
        "remarks",
        "status",
        "proof_of_attendance_file_link",
        "activity_id",
        "faculty_id"
    ];

    protected $dates = ['deleted_at'];

    public function activity(){
        return $this->belongsTo(Activity::class)->withDefault();
    }

    public function faculty(){
        return $this->belongsTo(Faculty::class)->withDefault();
    }
    public function activity_submitted()
    {
       return $this->hasMany(ActivityAttendanceSubmittedFile::class, 'aa_faculty_id')->without('aa_faculty_lists', 'created_by_user', 'updated_by_user');
    }

    // [Default relationship]       - Default
    public function created_by_user()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function updated_by_user()
    {
        return $this->belongsTo(User::class,'updated_by');
    }

    protected $with = ['activity_submitted', 'activity', 'faculty','created_by_user','updated_by_user'];

    // ADDED FOR UUID INCREMENT ERROR
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
}
