<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work_Shop extends Model
{
    protected $table = 'work_shops';
    protected $fillable = [
        'project_id',
        'user_id',
        'name',
        'description',
        'start_date',
        'end_date',
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
        return $this->hasMany(Donation::class, 'ws_id','id');
    }
}
