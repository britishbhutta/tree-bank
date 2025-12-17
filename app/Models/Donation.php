<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'user_id',
        'ws_id',
        'type',
        'description',
        'amount',
        'fund_type',
        'flow',
    ];
    public function users()
        {
            return $this->belongsTo(User::class, 'user_id', 'id');
        } 
    public function work_shops()
        {
            return $this->belongsTo(Work_Shop::class, 'ws_id', 'id');
        } 
    public function trees()
    {
        return $this->hasMany(Tree::class, 'donation_id','id');
    }
    public function treesOut()
    {
        return $this->hasMany(Tree::class, 'donation_id_out','id');
    }
}
