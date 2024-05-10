<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class Repair extends Model
    {
        use HasFactory;

        protected $fillable = [
            'description',
            'status',
            'startDate',
            'endDate',
            'mechanicNotes',
            'clientNotes',
            'user_id',
            'vehicle_id',
            'mechanic_id',

        ];
        public function mechanic()
        {
            return $this->belongsTo(User::class, 'mechanic_id'); // Define relationship with mechanics (User model)
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    public function spareParts()
    {
        return $this->belongsToMany(SparePart::class);
    }
//     public function spareParts()
// {
//     return $this->hasMany(SparePart::class);
// }

    
}
