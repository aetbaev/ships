<?php

namespace App\UseCase\Ship;

use App\Data\GalleryItemData;
use App\Data\ShipProcessingData;
use App\Services\Base64ImageSaver;
use Closure;

class SyncGallery
{
    public function __construct(private Base64ImageSaver $base64ImageSaver)
    {
    }

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

        // @todo переделать сохранение картинки предварительно на фронте
        $newGallery
            ->map(function (GalleryItemData $itemData) {
                if (str_starts_with($itemData->url, 'data')) {
                    $itemData->url = $this->base64ImageSaver->save($itemData->url);
                }
                return $itemData;
            })
            ->each(
                fn(GalleryItemData $galleryItemData) => $ship->gallery()->updateOrCreate(
                    ['id' => $galleryItemData->id],
                    $galleryItemData->toArray()
                )
            );

        return $next($data);
    }
}
