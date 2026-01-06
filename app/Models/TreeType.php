<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TreeType extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];
    public function trees()
    {
        return $this->hasMany(Tree::class, 'type_id','id');
    }
    
     public function treeNames()
    {
        return $this->hasMany(TreeName::class, 'tree_type_id');
    }
}
