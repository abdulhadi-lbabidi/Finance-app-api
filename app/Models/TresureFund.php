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

  public function tresure()
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

  public function innerTransactions()
  {
    return $this->hasMany(InnerTransaction::class, 'tresure_fund_id');
  }

  public function outerTransactions()
  {
    return $this->hasMany(OuterTransaction::class, 'tresure_fund_id');
  }
}