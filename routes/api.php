<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CollectController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\SessionController;

// open routes
Route::group(['domain' => 'api.' . parse_url(config('app.url'), PHP_URL_HOST), 'middleware' => []], function () {

    // events
    Route::post('/user', [SessionController::class, 'update'])->name('api.user');
    Route::post('/collect', [CollectController::class, 'store'])->name('api.collect');
    Route::post('/event', [EventController::class, 'store'])->name('api.event');
});
