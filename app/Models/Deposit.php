<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
  use HasFactory;
  protected $fillable = [
    'name',
    'desc',
  ];


  public function tresures()
  {
    return $this->morphMany(Tresure::class, 'tresureable');
  }
}