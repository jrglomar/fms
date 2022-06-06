<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// ADDED FOR UUID INCREMENT ERROR       - Always add it to new model
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class MeetingAttendanceRequiredFacultyList extends Model
{
    
    // -----  [[DEFAULT]]  -----  //
    use HasFactory, SoftDeletes;

    // [Modify this fillable base on tables]      - Can be modified
        protected $fillable = [
            'created_by',
            'updated_by',
            "time_in",
            "time_out",
            "attendance_status",
            "proof_of_attendance_file_directory",
            "proof_of_attendance_file_link",
            "faculty_id",
            "meeting_id"
        ];

        protected $dates = ['deleted_at'];

    
    // protected $with = ['users','created_by_user','updated_by_user'];

     // [Declare relationships here]
     public function meeting()
     {
         return $this->belongsTo(Meeting::class)->withDefault();
     }

     public function faculty()
     {
         return $this->belongsTo(Faculty::class)->withDefault();
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

    // [Added for UUID Incrementation]      - Default
    public $incrementing = false;

    protected $keyType = 'string';

    public static function boot(){
        parent::boot();

        static::creating(function ($issue) {
            $issue->id = Str::uuid(36);
        });
    }
    // 
// -----  [[DEFAULT]]  -----  //
}
