<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
  /** @use HasFactory<\Database\Factories\InvoiceFactory> */
  use HasFactory;

  protected $fillable = [
    'name',
    'desc',
    'amount',
    'finance_item_id',
    'invoiceable_id',
    'invoiceable_type',
    'discount_value',
    'discount_type',
    'final_price'
  ];


  public function invoiceable()
  {
    return $this->morphTo();
  }

  public function financeitem()
  {
    return $this->belongsTo(FinanceItem::class, 'finance_item_id', 'id');
  }
  public function invoiceitem()
  {
    return $this->hasMany(InvoiceItem::class);
  }

  public function logipays()
  {
    return $this->hasMany(LogiPay::class, 'invoice_id');
  }

  public function techpays()
  {
    return $this->hasMany(TechPay::class, 'invoice_id');
  }

  public function images()
  {
    return $this->morphMany(Image::class, 'imageable');
  }
}
