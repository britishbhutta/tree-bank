<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'project_id',
        'user_id',
        'name',
        'description',
        'start_date/time',
        'end_date/time',
        'images',
        'location',
    ];

    public function projects()
        {
            return $this->belongsTo(Project::class, 'project_id', 'id');
        } 
    public function users()
        {
            return $this->belongsTo(User::class, 'user_id', 'id');
        } 
    public function donations()
    {
        return $this->hasMany(Donation::class, 'event_id','id');
    }
}
