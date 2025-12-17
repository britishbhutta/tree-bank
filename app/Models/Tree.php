<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Tree extends Model
{
    protected $fillable = [
        'donation_id',
        'donation_id_out',
        'type_id',
        'user_id',
        'user_id_ct',
        'project_id',
        'age',
        'bought_date',
        'planting_status',
        'location',
        'planted_date',
        'last_visited_date',
        'visit_req',
        'notes',
        'purpose',
    ];
    public function donations()
        {
            return $this->belongsTo(Donation::class, 'donation_id', 'id');
        }
    public function donationsOut()
        {
            return $this->belongsTo(Donation::class, 'donation_id_out', 'id');
        } 
    public function treeTypes()
        {
            return $this->belongsTo(TreeType::class, 'type_id', 'id');
        }
    public function plantedBy()
        {
            return $this->belongsTo(User::class, 'user_id', 'id');
        } 
    public function CareTakenBy()
        {
            return $this->belongsTo(User::class, 'user_id_out', 'id');
        } 
    public function projects()
        {
            return $this->belongsTo(Project::class, 'project_id', 'id');
        } 
    public function photos()
    {
        return $this->hasMany(Photo::class, 'tree_id','id');
    }     
}
