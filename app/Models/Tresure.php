<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tresure extends Model
{
  /** @use HasFactory<\Database\Factories\TresureFactory> */
  use HasFactory;
  protected $table = 'tresures';

  protected $fillable = [
    'name',
    "tresureable_type",
    "tresureable_id",
    'active',
  ];


  public function tresureable()
  {
    return $this->morphTo();
  }

  public function tresurefunds()
  {
    return $this->hasMany(
      TresureFund::class,
      'tresure_id'
    );
  }
}
