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
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
    public function logisticteam()
    {
        return $this->belongsTo(LogisticTeam::class,'logistic_team_id');
    }
}
