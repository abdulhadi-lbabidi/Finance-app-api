<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoneyTranfare extends Model
{
  /** @use HasFactory<\Database\Factories\MoneyTranfareFactory> */
  use HasFactory;
  protected $table = 'money_tranfares';
  protected $fillable = [
    'name',
    'desc',
    'amount',
    'from_tresure_fund_id',
    'to_tresure_fund_id',
  ];

  public function fromtresurefund()
  {
    return $this->belongsTo(TresureFund::class, 'from_tresure_fund_id', 'id', 'tresure_funds');
  }
  public function totresurefund()
  {
    return $this->belongsTo(TresureFund::class, 'to_tresure_fund_id', 'id', 'tresure_funds');
  }
}
