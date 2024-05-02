<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparePart extends Model
{
    use HasFactory;
    protected $fillable = [
        'partName',
        'partReference',
        'supplier',
        'price',
        // 'repair_id'
    ];
    public function repairs()
    {
        return $this->belongsToMany(Repair::class);
    }
    // public function repair()
    // {
    //     return $this->belongsTo(Repair::class);
    // }
}
