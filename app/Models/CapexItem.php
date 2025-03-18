<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CapexItem extends Model {
    protected $fillable = ['farm_id', 'description', 'cost'];
}