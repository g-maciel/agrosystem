<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CropYield extends Model
{
    protected $table = 'crop_yields'; // Optional, Laravel infers 'crop_yields' from class name
    protected $fillable = ['farm_id', 'yield_liters', 'yield_sacas', 'selling_price'];
}