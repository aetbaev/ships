<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class SpecData extends Data
{
    public function __construct(
        public string  $name,
        public ?string $value = null,
    )
    {
    }
}
