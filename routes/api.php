<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CollectController;

// open routes
Route::group(['middleware' => []], function () {

    // events
    Route::post('/collect', [CollectController::class, 'store'])->name('api.events.store');
});


// closed routes
Route::group(['middleware' => ['auth:sanctum']], function () {

});
