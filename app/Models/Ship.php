<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ship extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title',
        'spec',
        'description',
        'ordering',
        'state',
    ];

    protected $casts = [
        'spec' => 'array',
    ];

    protected $attributes = [
        'spec' => '[]',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::creating(function (Ship $ship) {
            $ship->ordering = Ship::max('ordering') + 1;
        });
    }

    public function cabinCategories(): HasMany
    {
        return $this->hasMany(CabinCategory::class);
    }

    public function gallery(): HasMany
    {
        return $this->hasMany(ShipGallery::class);
    }
}
