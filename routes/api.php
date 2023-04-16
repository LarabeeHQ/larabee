<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CollectController;
use App\Http\Controllers\Api\EventController;

// open routes
Route::group(['middleware' => []], function () {

    // events
    Route::post('/collect', [CollectController::class, 'store'])->name('api.collect');
    Route::post('/event', [EventController::class, 'store'])->name('api.event');
});


// closed routes
Route::group(['middleware' => ['auth:sanctum']], function () {

});
