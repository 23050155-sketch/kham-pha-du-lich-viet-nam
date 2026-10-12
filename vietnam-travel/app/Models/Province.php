<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'administrative_type',
        'description',
        'cover_image',
    ];

    public function places(): HasMany
    {
        return $this->hasMany(Place::class);
    }


    public function itineraries(): HasMany
    {
        return $this->hasMany(Itinerary::class);
    }
}