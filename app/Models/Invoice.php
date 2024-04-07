<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'additionalCharges',
        'totalAmount',
        'repair_id'
    ];

    public function repair()
    {
        return $this->belongsTo(Repair::class);
    }
    
 
}
