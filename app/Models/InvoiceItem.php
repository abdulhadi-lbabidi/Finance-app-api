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
        'price',
        'finalprice',
        'invoice_id'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }




}
