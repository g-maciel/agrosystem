<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaborCost extends Model {
    protected $fillable = ['farm_id', 'total_labor_cost'];
}