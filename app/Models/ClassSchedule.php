<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// ADDED FOR UUID INCREMENT ERROR       - Always add it to new model
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassSchedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "room_id",
        "subject_offering_id",
        "code",
        "day",
        "start_time",
        "end_time",
    ];

    protected $dates = ['deleted_at'];


    public function room(){
        return $this->belongsTo(Room::class)->withDefault();
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
