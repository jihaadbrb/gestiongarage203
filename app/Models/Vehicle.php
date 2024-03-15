<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = [
        'make',
        'model',
        'fuelType',
        'registration',
        'photos',
        'client_id'
    ];

    public function repair()
    {
        return $this->hasMany(Repair::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
