<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// ADDED FOR UUID INCREMENT ERROR       - Always add it to new model
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityAttendanceRequiredFacultyList extends Model
{
    use HasFactory;

    protected $fillable = [
        "time_in",
        "time_out",
        "attendance_status",
        "proof_of_attendance_file_directory",
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

    // [Default relationship]       - Default
    public function created_by_user()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function updated_by_user()
    {
        return $this->belongsTo(User::class,'updated_by');
    }

    // ADDED FOR UUID INCREMENT ERROR
    public $incrementing = false;

    protected $keyType = 'string';

    public static function boot(){
        parent::boot();

        static::creating(function ($issue) {
            $issue->id = Str::uuid(36);
        });
    }
    // 
}
