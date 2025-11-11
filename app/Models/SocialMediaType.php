<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMediaType extends Model
{
    /** @use HasFactory<\Database\Factories\SocialMediaTypeFactory> */
    use HasFactory;

        protected $fillable = [
        'name',
        'vec_url',
    ];


        public function socialmedias()
    {
        return $this->hasMany(SocialMedia::class,'socialmediatype_id');
    }
}
