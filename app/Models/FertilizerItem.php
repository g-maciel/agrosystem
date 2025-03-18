<?php   
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FertilizerItem extends Model {
    protected $fillable = ['farm_id', 'description', 'cost'];
}