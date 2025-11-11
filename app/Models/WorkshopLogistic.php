<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkshopLogistic extends Model
{
    /** @use HasFactory<\Database\Factories\WorkshopLogisticFactory> */
    use HasFactory;

    protected $fillable = [
        'logistic_team_id',
        'workshop_id',
    ];

    // public function workshop()
    // {
    //     return $this->belongsTo(Workshop::class, 'workshop_id');
    // }
    // public function logistic()
    // {
    //     return $this->belongsTo(LogisticTeam::class, 'logistic_team_id');
    // }
}
