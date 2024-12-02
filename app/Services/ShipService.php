<?php

namespace App\Services;

use App\Data\ShipData;
use App\Data\ShipProcessingData;
use App\Models\Ship;
use App\UseCase\Ship\ProcessShip;
use App\UseCase\Ship\SyncCabinCategories;
use App\UseCase\Ship\SyncGallery;
use DomainException;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Pipeline;

class ShipService
{
    public function create(ShipData $data): Ship
    {
        DB::beginTransaction();

        try {
            $shipProcessingData = new ShipProcessingData(
                ship: new Ship,
                data: $data,
            );

            /** @var ShipProcessingData $shipProcessingData */
            $shipProcessingData = Pipeline::send($shipProcessingData)
                ->through([
                    ProcessShip::class,
                    SyncCabinCategories::class,
                    SyncGallery::class,
                ])
                ->thenReturn();

            DB::commit();
        } catch (DomainException $e) {
            DB::rollBack();
            throw $e;
        } catch (Exception $e) {
            DB::rollBack();
            throw new DomainException('Произошла ошибка при сохранении информации', 0, $e);
        }

        return $shipProcessingData->ship;
    }

    public function update(Ship $ship, ShipData $data): Ship
    {
        DB::beginTransaction();

        try {
            $shipProcessingData = new ShipProcessingData(
                ship: $ship,
                data: $data,
            );

            /** @var ShipProcessingData $shipProcessingData */
            $shipProcessingData = Pipeline::send($shipProcessingData)
                ->through([
                    ProcessShip::class,
                    SyncCabinCategories::class,
                    SyncGallery::class,
                ])
                ->thenReturn();

            DB::commit();
        } catch (DomainException $e) {
            DB::rollBack();
            throw $e;
        } catch (Exception $e) {
            DB::rollBack();
            throw new DomainException('Произошла ошибка при сохранении информации', 0, $e);
        }

        return $shipProcessingData->ship;
    }
}
