<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// ADDED FOR UUID INCREMENT ERROR       - Always add it to new model
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meeting extends Model
{
    // -----  [[DEFAULT]]  -----  //
    use HasFactory, SoftDeletes;

    // [Modify this fillable base on tables]      - Can be modified
        protected $fillable = [
            'created_by',
            'updated_by',
            "title",
            "start_time",
            "end_time",
            "agenda",
            "description",
            "status",
            "meeting_types_id"
        ];

        protected $dates = ['deleted_at'];

    
    // protected $with = ['users','created_by_user','updated_by_user'];

    
    // [Declare relationships here]
    public function meeting_type()
    {
        return $this->belongsTo(MeetingType::class)->withDefault();
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
