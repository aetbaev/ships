<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShipGallery extends Model
{
    protected $table = 'ships_gallery';

    public $timestamps = false;

    protected $fillable = [
        'ship_id',
        'title',
        'url',
        'ordering',
    ];

    public function ship(): BelongsTo
    {
        return $this->belongsTo(Ship::class);
    }
}
