<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['name', 'daily_hours', 'hourly_cost', 'role_id'];

    public function role()
    {
        return $this->belongsTo(EmployeeRole::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}