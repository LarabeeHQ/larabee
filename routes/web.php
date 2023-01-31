<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebsiteController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return route('login');
});

Route::group(['middleware' => ['auth', 'verified']], function () {

    // websites
    Route::get('/websites', [WebsiteController::class, 'index'])->name('websites.index');
    Route::get('/websites/create', [WebsiteController::class, 'create'])->name('websites.create');
    Route::post('/websites', [WebsiteController::class, 'store'])->name('websites.store');
    Route::get('/websites/{id}', [WebsiteController::class, 'show'])->name('websites.show');
    Route::put('/websites/update-current', [WebsiteController::class, 'setCurrentWebsite'])->name('websites.update-current');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
