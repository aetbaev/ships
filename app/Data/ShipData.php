<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class ShipData extends Data
{
    public function __construct(
        #[Rule(['required', 'string'])]
        public string $title,
        #[Rule(['required', 'string'])]
        public string $description,
        /** @var array<int, SpecData> */
        public array  $spec = [],
        /** @var array<string, CabinData> */
        public array  $cabins = [],
        /** @var array<string, GalleryItemData> */
        public array  $gallery = [],
    )
    {
        if (empty(trim(strip_tags($this->description)))) {
            $this->description = '';
        }
    }

    public static function messages(): array
    {
        return [
            'title.required' => 'Укажите название лайнера',
            'description.required' => 'Укажите описание лайнера',
        ];
    }
}
