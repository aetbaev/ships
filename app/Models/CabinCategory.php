<?php

namespace App\Models;

use App\Enums\CabinCategoryType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CabinCategory extends Model
{
    protected $table = 'cabin_categories';

    public $timestamps = false;

    protected $fillable = [
        'ship_id',
        'vendor_code',
        'title',
        'type',
        'description',
        'photos',
        'ordering',
        'state',
    ];

    protected $casts = [
        'type' => CabinCategoryType::class,
        'photos' => 'array',
    ];

    public function ship(): BelongsTo
    {
        return $this->belongsTo(Ship::class);
    }
}
