<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechPay extends Model
{
    /** @use HasFactory<\Database\Factories\TechPayFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'amount',
        'price',
        'finalprice',
        'payed',
        'workshopname',
        'technical_team_id',
        'invoice_id',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
    public function technicalteam()
    {
        return $this->belongsTo(TechnicalTeam::class,'technical_team_id');
    }
}
