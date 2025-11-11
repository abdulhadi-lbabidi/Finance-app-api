<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Workshop extends Model
{
    /** @use HasFactory<\Database\Factories\WorkshopFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'customer_id',
    ];

    public function tresures()
    {
        return $this->morphMany(Tresure::class, 'tresureable');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function inventories()
    {
        return $this->morphMany(Inventory::class, 'invetorable');
    }
    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class,'employee_workshops')->withPivot('id');
    }
    public function logistics()
    {
        return $this->belongsToMany(LogisticTeam::class, 'workshop_logistics')->withPivot('id');
    }
}
