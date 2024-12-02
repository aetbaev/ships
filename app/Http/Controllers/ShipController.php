<?php

namespace App\Http\Controllers;

use App\Data\ShipData;
use App\Enums\CabinCategoryType;
use App\Models\Ship;
use App\Services\ShipService;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class ShipController extends Controller
{
    public function index(): Application|Factory|View
    {
        $ships = Ship::query()
            ->select(['id', 'title', 'state'])
            ->with([
                'gallery' => fn(HasMany $query) => $query
                    ->select(['id', 'url', 'ship_id'])
                    ->orderBy('ordering')
                    ->limit(1),
            ])
            ->orderBy('ordering')
            ->get();

        return view('ships.index', compact('ships'));
    }

    public function create(): View|Factory|Application
    {
        $ship = new Ship;
        $cabinCategoryTypes = CabinCategoryType::cases();

        return view('ships.create', compact('ship', 'cabinCategoryTypes'));
    }

    public function store(ShipData $data, ShipService $service): RedirectResponse
    {
        try {
            $service->create($data);

            return redirect()
                ->route('ships.index')
                ->with('success', 'Информация успешно сохранена');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit(Ship $ship): View|Factory|Application
    {
        $ship->load([
            'gallery' => fn(HasMany $query) => $query->orderBy('ordering'),
            'cabinCategories' => fn(HasMany $query) => $query->orderBy('ordering')
        ]);

        $cabinCategoryTypes = CabinCategoryType::cases();

        return view('ships.edit', compact('ship', 'cabinCategoryTypes'));
    }

    public function update(ShipData $data, Ship $ship, ShipService $service): RedirectResponse
    {
        try {
            $service->update($ship, $data);

            return redirect()
                ->route('ships.index')
                ->with('success', 'Информация успешно обновлена');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Ship $ship): RedirectResponse
    {
        $ship->delete();

        return redirect()
            ->route('ships.index')
            ->with('success', 'Лайнер удален');
    }
}
