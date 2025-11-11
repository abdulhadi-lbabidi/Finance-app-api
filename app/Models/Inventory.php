<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    /** @use HasFactory<\Database\Factories\InventoryFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'quantity',
        'statue',
        'type',
        'fromdate',
    ];
    public function invetorable()
    {
        return $this->morphTo();
    }
}
