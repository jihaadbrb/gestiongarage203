<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['user_id', 'message','sender_id'];

    // Define the relationship between notifications and users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
