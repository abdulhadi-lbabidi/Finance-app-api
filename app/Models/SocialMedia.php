<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    /** @use HasFactory<\Database\Factories\SocialMediaFactory> */
    use HasFactory;

        protected $fillable = [
        'url',
        'socialmediatype_id'
    ];


    public function mediaable()
    {
        return $this->morphTo();
    }

    public function meidatype()
    {
        return $this->belongsTo(SocialMediaType::class,'socialmediatype_id');
    }
}
