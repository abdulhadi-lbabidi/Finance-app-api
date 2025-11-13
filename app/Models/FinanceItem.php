<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanceItem extends Model
{
    /** @use HasFactory<\Database\Factories\FinanceItemFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function invoice()
    {
        return $this->hasMany(Invoice::class,);
    }
}
