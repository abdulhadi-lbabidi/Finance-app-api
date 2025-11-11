<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
    ];

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function workshops()
    {
        return $this->hasMany(Workshop::class);
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
