<?php

namespace App\Data;

use App\Models\Ship;
use Spatie\LaravelData\Data;

class ShipProcessingData extends Data
{
    public function __construct(
        public Ship     $ship,
        public ShipData $data
    )
    {
    }
}
