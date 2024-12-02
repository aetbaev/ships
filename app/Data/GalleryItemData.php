<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class GalleryItemData extends Data
{
    public function __construct(
        public string $id,
        public string $title,
        public string $url,
        public int    $ordering,
    )
    {
    }

    public static function messages(): array
    {
        return [
            'title.required' => 'Укажите название фото в галерее #:position',
        ];
    }
}
