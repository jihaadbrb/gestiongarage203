<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstName',
        'lastName',
        'address',
        'phoneNumber',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle()
    {
        return $this->hasMany(Vehicle::class);
    }
    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }
    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }
}
