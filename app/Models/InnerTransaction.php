<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InnerTransaction extends Model
{
    /** @use HasFactory<\Database\Factories\InnerTransactionFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'payed',
        'amount',
        'tresure_fund_id',
        'indate',
    ];

    public function tresurefund()
    {
        return $this->belongsTo(TresureFund::class);
    }
    public function invoices()
    {
        return $this->morphMany(Invoice::class,'invoiceable');
    }
        public function images()
    {
        return $this->morphMany(Invoice::class,'imageable');
    }

}
