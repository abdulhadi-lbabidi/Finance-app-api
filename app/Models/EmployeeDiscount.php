<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDiscount extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeDiscountFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'amount',
        'emppay_id',
    ];
    public function employeepay()
    {
        return $this->belongsTo(EmployeePay::class,'emppay_id');
    }

}
