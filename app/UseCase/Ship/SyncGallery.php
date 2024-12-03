<?php

namespace App\UseCase\Ship;

use App\Data\GalleryItemData;
use App\Data\ShipProcessingData;
use Closure;

class SyncGallery
{
    public function __invoke(ShipProcessingData $data, Closure $next)
    {
        $ship = $data->ship;

        $currentIds = $ship->gallery()->pluck('id');

        $newGallery = collect($data->data->gallery);

        $saveIds = $newGallery->pluck('id')->filter(
            fn($value) => !preg_match('/^\_/', $value)
        );

        $deletedIds = $currentIds->diff($saveIds);

        $ship->gallery()->whereIn('id', $deletedIds)->delete();

        $newGallery->each(
            fn(GalleryItemData $galleryItemData) => $ship->gallery()->updateOrCreate(
                ['id' => $galleryItemData->id],
                $galleryItemData->toArray()
            )
        );

        return $next($data);
    }
}
