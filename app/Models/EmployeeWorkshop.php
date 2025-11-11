<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeWorkshop extends Model
{
    /** @use HasFactory<\Database\Factories\WorkshopEmployeeFactory> */
    use HasFactory;

        protected $fillable = [
        'employee_id',
        'workshop_id',
    ];

    // public function employee()
    // {
    //     return $this->belongsTo(Employee::class, 'employee_id');
    // }
    // public function workshop()
    // {
    //     return $this->belongsTo(Workshop::class, 'workshop_id');
    // }
}
