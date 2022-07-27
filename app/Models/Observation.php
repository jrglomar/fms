<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// ADDED FOR UUID INCREMENT ERROR       - Always add it to new model
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

// ADDED FOR CREATED AND UPDATED BY AUTOMATION
use Illuminate\Support\Facades\Auth;

class Observation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "date_of_observation",
        'status',
        "remarks",
        "proof_of_observation_file_directory",
        "proof_of_observation_file_link",
        "class_schedule_id"
    ];

    protected $dates = ['deleted_at'];


    // [Declare relationships here]
    public function faculty(){
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

    
    protected $with = ['created_by_user', 'faculty'];

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
