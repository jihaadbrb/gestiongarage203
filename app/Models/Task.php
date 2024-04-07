<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function mechanics()
    {
        return $this->belongsToMany(User::class, 'mechanic_tasks')->withTimestamps();
    }
}
