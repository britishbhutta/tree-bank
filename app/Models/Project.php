<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'is_active',
    ];
    public function events()
    {
        return $this->hasMany(Event::class, 'project_id','id');
    }
    public function trees()
    {
        return $this->hasMany(Tree::class, 'project_id','id');
    }
}
