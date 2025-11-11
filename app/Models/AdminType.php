<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminType extends Model
{
    /** @use HasFactory<\Database\Factories\AdminTypeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function admin()
    {
        return $this->hasMany(Admin::class);
    }
}
