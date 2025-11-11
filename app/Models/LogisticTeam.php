<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogisticTeam extends Model
{
    /** @use HasFactory<\Database\Factories\LogisticTeamFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
    ];
    public function logipays()
    {
        return $this->hasMany(LogiPay::class);
    }

    public function phones()
    {
        return $this->morphMany(Phone::class, 'phoneable');
    }
    public function socialmedias()
    {
        return $this->morphMany(SocialMedia::class, 'mediaable');
    }
    public function documents()
    {
        return $this->morphMany(Document::class, 'doucumentable');
    }
        public function inventories()
    {
        return $this->morphMany(Inventory::class, 'invetorable');
    }

    public function workshops()
    {
        return $this->belongsToMany(Workshop::class, );
    }
}
