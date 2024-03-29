<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// ADDED FOR UUID INCREMENT ERROR       - Always add it to new model
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

// ADDED FOR CREATED AND UPDATED BY AUTOMATION
use Illuminate\Support\Facades\Auth;


class Faculty extends Model
{
    // -----  [[DEFAULT]]  -----  //
        use HasFactory, SoftDeletes;
        // [Modify this fillable base on tables]      - Can be modified
            protected $fillable = [
                'salutation',
                'first_name',
                'middle_name',
                'last_name',
                'gender',
                'birthdate',
                'birthplace',
                'hire_date',
                'phone_number',
                'province',
                'city',
                'barangay',
                'street',
                'house_number',
                'created_by',
                'updated_by',
                'image',
                // FK
                'user_id',
                'academic_rank_id',
                'faculty_type_id',
                'designation_id',
                'specialization_id',
            ];

            protected $dates = ['deleted_at'];


        // protected $with = ['users','created_by_user','updated_by_user'];

        // [Declare relationships here]
            public function user()
            {
                return $this->belongsTo(User::class);
            }

            public function faculty_type()
            {
                return $this->belongsTo(FacultyType::class);
            }

            public function academic_rank()
            {
                return $this->belongsTo(AcademicRank::class);
            }

            public function designation()
            {
                return $this->belongsTo(Designation::class);
            }

            public function specialization()
            {
                return $this->belongsTo(Specialization::class);
            }
            
            public function requirement_required_faculty_list()
            {
                return $this->hasMany(RequirementRequiredFacultyList::class)->without('faculty', 'created_by_user', 'updated_by_user', 'requirement_bin');
            }

            public function activity_attendance_required_faculty_list()
            {
                return $this->hasMany(ActivityAttendanceRequiredFacultyList::class)->without('faculty', 'created_by_user', 'updated_by_user', 'activity');
            }

            public function meeting_attendance_required_faculty_list()
            {
                return $this->hasMany(MeetingAttendanceRequiredFacultyList::class)->without('faculty', 'created_by_user', 'updated_by_user', 'meeting');
            }

            public function faculty_education_profile()
            {
                return $this->hasMany(FacultyEducationProfile::class)->without('faculty');
            }

            public function faculty_program()
            {
                return $this->hasMany(FacultyProgram::class)->without('program_faculty', 'created_by_user', 'updated_by_user');
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

        protected $with = ['academic_rank', 'faculty_program', 'designation', 'specialization', 'faculty_type', 'user', 
        'created_by_user','updated_by_user', 'requirement_required_faculty_list',
        'activity_attendance_required_faculty_list', 'meeting_attendance_required_faculty_list', 'faculty_education_profile'];


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
