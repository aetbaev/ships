<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ShipController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('home');

Route::post('/images', [ImageController::class, 'store'])->name('images.store');

Route::resource('ships', ShipController::class)->except('show');
