<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    /** @use HasFactory<\Database\Factories\DocumentFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'url'
    ];

    public function doucumentable()
    {
        return $this->morphTo();
    }
}
