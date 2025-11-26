<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TresureFund extends Model
{
  /** @use HasFactory<\Database\Factories\TresureFundFactory> */
  use HasFactory;

  protected $table = 'tresure_funds';
  protected $fillable = [
    'name',
    'desc',
    'tresure_id',
  ];

  public function tresures()
  {
    return $this->belongsTo(Tresure::class);
  }
  public function moneyTransfares()
  {
    return $this->hasMany(MoneyTranfare::class, 'to_tresure_fund_id');
  }
  public function moneyGets()
  {
    return $this->hasMany(MoneyTranfare::class, 'from_tresure_fund_id');
  }
}
