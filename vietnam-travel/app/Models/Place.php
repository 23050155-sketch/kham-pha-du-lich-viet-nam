<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;



class Place extends Model
{
    protected $fillable = [
        'province_id',
        'name',
        'slug',
        'short_description',
        'description',
        'address',
        'ticket_price',
        'open_time',
        'close_time',
        'visit_duration_min',
        'best_time',
        'latitude',
        'longitude',
        'view_count',
        'is_featured',
        'status',
        'cover_image',
        'best_months',
        'notes',
        'activities',
    ];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }


    public function images(): HasMany
    {
        return $this->hasMany(PlaceImage::class)
            ->orderBy('sort_order');
    }


    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }


    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }


    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }


    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }


    public function itineraryItems(): HasMany
    {
        return $this->hasMany(ItineraryItem::class);
    }
}