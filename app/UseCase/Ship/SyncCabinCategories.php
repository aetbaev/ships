<?php

namespace App\UseCase\Ship;

use App\Data\CabinData;
use App\Data\ShipProcessingData;
use Closure;

class SyncCabinCategories
{
    public function __invoke(ShipProcessingData $data, Closure $next)
    {
        $ship = $data->ship;

        $currentIds = $ship->cabinCategories()->pluck('id');

        $newCabins = collect($data->data->cabins);

        $saveIds = $newCabins->pluck('id')->filter(
            fn($value) => !preg_match('/^\_/', $value)
        );

        $deletedIds = $currentIds->diff($saveIds);

        $ship->cabinCategories()->whereIn('id', $deletedIds)->delete();

        $newCabins->each(
            fn(CabinData $cabinData) => $ship->cabinCategories()->updateOrCreate(
                ['id' => $cabinData->id],
                $cabinData->toArray()
            )
        );

        return $next($data);
    }
}
