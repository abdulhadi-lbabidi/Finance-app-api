<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
  /** @use HasFactory<\Database\Factories\EmployeeFactory> */
  use HasFactory;

  protected $fillable = [
    'name',
    'address',
    'employee_type_id',
    'department_id'
  ];

  public function user()
  {
    return $this->morphOne(User::class, 'userable');
  }

  public function tresures()
  {
    return $this->morphMany(Tresure::class, 'tresureable');
  }

  // public function tresure()
  // {
  //   return $this->morphOne(Tresure::class, 'tresureable');
  // }
  public function employeepays()
  {
    return $this->hasMany(EmployeePay::class);
  }
  public function invoices()
  {
    return $this->hasManyThrough(Invoice::class, EmployeePay::class);
  }
  public function type()
  {
    return $this->belongsTo(EmployeeType::class);
  }
  public function department()
  {
    return $this->belongsTo(Department::class);
  }

  public function phones()
  {
    return $this->morphMany(Phone::class, 'phoneable');
  }
  public function socialmedias()
  {
    return $this->morphMany(SocialMedia::class, 'mediaable');
  }
  public function documents()
  {
    return $this->morphMany(Document::class, 'doucumentable');
  }
  public function inventories()
  {
    return $this->morphMany(Inventory::class, 'invetorable');
  }

  public function workshops()
  {
    return $this->belongsToMany(Workshop::class, 'employee_workshops');
  }
}