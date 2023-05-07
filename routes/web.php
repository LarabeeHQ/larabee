<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\App\AnalyticsController;
use App\Http\Controllers\App\AccountController;
use App\Http\Controllers\App\WebsiteController;
use App\Http\Controllers\App\BillingController;
use App\Http\Controllers\App\UserController;

Route::get('/', function () {
    return redirect('/login');
});

Route::group(['middleware' => ['auth', 'verified', 'app.set-locale', 'app.set-website', 'check.trial']], function () {

    // dashboard
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');
    Route::get('/analytics/statistics', [AnalyticsController::class, 'statistics'])->name('analytics.statistics');

    // websites
    Route::put('/websites/update-current', [WebsiteController::class, 'setCurrentWebsite'])->name('websites.update-current');
    Route::get('/websites/create', [WebsiteController::class, 'create'])->name('websites.create');
    Route::post('/websites', [WebsiteController::class, 'store'])->name('websites.store');
    Route::get('/website/edit', [WebsiteController::class, 'edit'])->name('websites.edit');
    Route::put('/website', [WebsiteController::class, 'update'])->name('websites.update');
    Route::get('/websites/favicon/{url}', [WebsiteController::class, 'favicon'])->name('websites.favicon');

    // users (sessions)
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // account
    Route::get('/account', [AccountController::class, 'edit'])->name('account.edit');
    Route::post('/account', [AccountController::class, 'update'])->name('account.update');
    Route::post('/account/update-password', [AccountController::class, 'updatePassword'])->name('account.update-password');
    Route::delete('/account', [AccountController::class, 'destroy'])->name('account.destroy');

    // billing
    Route::get('/billing', [BillingController::class, 'index'])->name('billing.index');
    Route::get('/billing/redirect-to-portal', [BillingController::class, 'redirectToPortal'])->name('billing.redirect-to-portal');
    Route::post('/billing/generate-checkout-link', [BillingController::class, 'generateCheckoutLink'])->name('billing.generate-checkout-link');
    Route::get('/billing/upgrade-success', [BillingController::class, 'index'])->name('billing.upgrade-success');
    Route::inertia('/billing/upgrade-success', 'Billing/success');
});

require __DIR__.'/auth.php';
