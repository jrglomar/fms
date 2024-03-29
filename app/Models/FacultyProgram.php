<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

// ADDED FOR UUID INCREMENT ERROR
use Illuminate\Support\Str;

// ADDED FOR CREATED AND UPDATED BY AUTOMATION
use Illuminate\Support\Facades\Auth;

class FacultyProgram extends Model
{
    // -----  [[DEFAULT]]  -----  //
        use HasFactory, SoftDeletes;

        // [Modify this fillable base on tables]      - Can be modified
            protected $fillable = [
                "faculty_id",
                "program_id"
            ];

        protected $dates = ['deleted_at'];

        // protected $with = ['users','created_by_user','updated_by_user'];

        // [Declare relationships here]
            public function program_faculty(){
                return $this->belongsTo(Faculty::class, 'faculty_id')->without('faculty_id');
                // return $this->belongsTo(RequirementBin::class)->withDefault();
            }

            public function program(){
                return $this->belongsTo(Program::class, "program_id");
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

        protected $with = ['program_faculty', 'program','created_by_user','updated_by_user'];

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
