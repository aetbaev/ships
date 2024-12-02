<?php

namespace App\Data;

use App\Enums\CabinCategoryType;
use Spatie\LaravelData\Attributes\Validation\Enum;
use Spatie\LaravelData\Data;

class CabinData extends Data
{
    public function __construct(
        public string $id,
        public string $title,
        public string $vendor_code,
        #[Enum(CabinCategoryType::class)]
        public string $type,
        public string $description,
        public ?array $photos = null,
    )
    {
        if (empty(trim(strip_tags($this->description)))) {
            $this->description = '';
        }
    }

    public static function messages(): array
    {
        return [
            'title.required' => 'Укажите название каюты #:position',
            'vendor_code.required' => 'Укажите код категории каюты #:position',
            'type.required' => 'Укажите тип категории каюты #:position',
            'description.required' => 'Укажите описание каюты #:position',
        ];
    }
}
