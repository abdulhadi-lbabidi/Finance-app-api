<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    /** @use HasFactory<\Database\Factories\AdminFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'admin_level',
        'department',
        'admintype_id'
    ];

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function tresures()
    {
        return $this->morphMany(Tresure::class, 'tresureable');
    }
    public function type()
    {
        return $this->belongsTo(AdminType::class,'admintype_id');
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
