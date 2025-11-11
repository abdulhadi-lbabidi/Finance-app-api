<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePay extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeePayFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'desc',
        'amount',
        'price',
        'finalprice',
        'payed',
        'invoice_id',
        'employee_id'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function discounts()
    {
        return $this->hasMany(EmployeeDiscount::class);
    }
    public function rewards()
    {
        return $this->hasMany(EmployeeReward::class);
    }
}
