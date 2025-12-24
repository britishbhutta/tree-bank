<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'tree_id',
        'ws_id',
        'taken_date',
        'description',
    ];
    public function trees()
        {
            return $this->belongsTo(Tree::class, 'tree_id', 'id');
        }
    public function work_shop()
    {
        return $this->belongsTo(Work_Shop::class, 'ws_id','id');
    }
}
