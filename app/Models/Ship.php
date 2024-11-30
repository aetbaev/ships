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

    public function cabinCategories(): HasMany
    {
        return $this->hasMany(CabinCategory::class);
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(ShipGallery::class);
    }
}
