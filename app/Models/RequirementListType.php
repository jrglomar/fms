<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

// ADDED FOR UUID INCREMENT ERROR
use Illuminate\Support\Str;

// ADDED FOR CREATED AND UPDATED BY AUTOMATION
use Illuminate\Support\Facades\Auth;

class RequirementListType extends Model
{
    // -----  [[DEFAULT]]  -----  //
        use HasFactory, SoftDeletes;

        // [Modify this fillable base on tables]      - Can be modified
            protected $fillable = [
                "requirement_bin_id",
                "requirement_type_id"
            ];

        protected $dates = ['deleted_at'];

        // protected $with = ['users','created_by_user','updated_by_user'];

        // [Declare relationships here]
            public function requirement_bin(){
                return $this->belongsTo(RequirementBin::class, 'requirement_bin_id')->without('requirement_bin');
                // return $this->belongsTo(RequirementBin::class)->withDefault();
            }

            public function requirement_type(){
                return $this->belongsTo(RequirementType::class, "requirement_type_id");
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

        protected $with = ['requirement_bin', 'requirement_type','created_by_user','updated_by_user'];

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
