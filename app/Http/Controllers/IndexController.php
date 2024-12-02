<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class IndexController extends Controller
{
    public function __invoke(): Application|Redirector|RedirectResponse
    {
        return redirect(route('ships.index'));
    }
}
