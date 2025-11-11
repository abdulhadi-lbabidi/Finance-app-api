<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicalTeam extends Model
{
    /** @use HasFactory<\Database\Factories\TechnicalTeamFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'spec'
    ];

    public function techpays()
    {
        return $this->hasMany(TechPay::class);
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
}
