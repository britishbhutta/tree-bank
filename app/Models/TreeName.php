<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreeName extends Model
{
    use HasFactory;

    protected $table = 'tree_names';

    protected $fillable = [
        'tree_type_id',
        'name',
        'description',
    ];

    public function treeType()
    {
        return $this->belongsTo(TreeType::class, 'tree_type_id');
    }
}
