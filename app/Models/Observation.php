<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// ADDED FOR UUID INCREMENT ERROR       - Always add it to new model
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class Observation extends Model
{
    use HasFactory;

    protected $fillable = [
        "date_of_observation",
        "remarks",
        "proof_of_observation_file_directory",
        "proof_of_observation_file_link",
        "schedule_id"
    ];

    protected $dates = ['deleted_at'];

    // protected $with = ['users','created_by_user','updated_by_user'];

    // [Declare relationships here]
    

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
