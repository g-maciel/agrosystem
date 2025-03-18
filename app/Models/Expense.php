<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['category_id', 'amount', 'employee_id', 'payment_date', 'receipt', 'description'];

    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}