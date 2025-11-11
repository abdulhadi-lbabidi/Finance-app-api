<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    /** @use HasFactory<\Database\Factories\OfficeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'location',
    ];

        public function tresure()
    {
        return $this->morphOne(Tresure::class, 'tresureable');
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
