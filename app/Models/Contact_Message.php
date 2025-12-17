<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact_Message extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'subject',
        'message',
    ];

    public function users()
        {
            return $this->belongsTo(User::class, 'user_id', 'id');
        } 

}
