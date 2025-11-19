<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /** @use HasFactory<\Database\Factories\ImageFactory> */
    use HasFactory;

    protected $fillable = [
        'url',
    ];
    protected $appends = ['fullUrl'];

    public function imageable()
    {
        return $this->morphTo();
    }
    public function getFullUrlAttribute()
    {
        return asset('storage/' . $this->attributes['url']);
    }
}