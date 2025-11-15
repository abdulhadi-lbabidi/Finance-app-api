<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    /** @use HasFactory<\Database\Factories\InvoiceItemFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'amount',
        'payed',
        'price',
        'finalprice',
        'invoice_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($techPay) {
            $techPay->finalprice = $techPay->amount * $techPay->price;
        });

        static::updating(function ($techPay) {
            $techPay->finalprice = $techPay->amount * $techPay->price;
        });
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
