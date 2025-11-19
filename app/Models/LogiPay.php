<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogiPay extends Model
{
    /** @use HasFactory<\Database\Factories\LogiPayFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'amount',
        'price',
        'finalprice',
        'payed',
        'workshopname',
        'logistic_team_id',
        'invoice_id',
        'discount_type',
        'discount_value',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($techPay) {
            $total = $techPay->amount * $techPay->price;

            if ($techPay->discount_type === 'نسبة') {
                $discount = $total * ($techPay->discount_value / 100);
            } else {
                $discount = $techPay->discount_value ?? 0;
            }
            $techPay->finalprice = $total - $discount;
        });

        static::updating(function ($techPay) {
            $total = $techPay->amount * $techPay->price;

            if ($techPay->discount_type === 'نسبة') {
                $discount = $total * ($techPay->discount_value / 100);
            } else {
                $discount = $techPay->discount_value ?? 0;
            }

            $techPay->finalprice = $total - $discount;
        });
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
    public function logisticteam()
    {
        return $this->belongsTo(LogisticTeam::class, 'logistic_team_id');
    }
}
