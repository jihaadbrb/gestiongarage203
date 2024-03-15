<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparePartRepair extends Model
{
    use HasFactory;

    protected $fillable = [
        'spare_part_id',
        'repair_id',
    ];

}
