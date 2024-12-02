<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ShipController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('home');

Route::resource('ships', ShipController::class)->except('show');
