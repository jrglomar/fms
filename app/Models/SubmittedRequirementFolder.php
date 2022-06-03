<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

// ADDED FOR UUID INCREMENT ERROR
use Illuminate\Support\Str;

class SubmittedRequirementFolder extends Model
{
    // -----  [[DEFAULT]]  -----  //
        use HasFactory, SoftDeletes;

        // [Modify this fillable base on tables]      - Can be modified
            protected $fillable = [
                "remarks",
                "requirement_bin_id",
                "faculty_id"
            ];

        protected $dates = ['deleted_at'];

        // protected $with = ['users','created_by_user','updated_by_user'];

        // [Declare relationships here]
            public function faculty(){
                return $this->belongsTo(Faculty::class)->withDefault();
            }
            
            public function requirements_bin(){
                return $this->belongsTo(RequirementBin::class)->withDefault();
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
