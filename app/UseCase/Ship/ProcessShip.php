<?php

namespace App\UseCase\Ship;

use App\Data\ShipProcessingData;
use Closure;

class ProcessShip
{
    public function __invoke(ShipProcessingData $data, Closure $next)
    {
        $ship = $data->ship;

        $ship->fill([
            'title' => $data->data->title,
            'description' => $data->data->description,
            'spec' => $data->data->spec,
        ]);

        $ship->save();

        $data->ship = $ship;
        $data->ship->refresh();

        return $next($data);
    }
}
