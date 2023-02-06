<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\BillingController;

Route::get('/', function () {
    return redirect(route('login'));
});

Route::group(['middleware' => ['auth', 'verified']], function () {

    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/statistics/overview', [DashboardController::class, 'overview'])->name('dashboard.overview');

    Route::get('/dashboard/statistics/pages', [DashboardController::class, 'pages'])->name('dashboard.pages');
    Route::get('/dashboard/statistics/entry-pages', [DashboardController::class, 'entryPages'])->name('dashboard.entry-pages');
    Route::get('/dashboard/statistics/exit-pages', [DashboardController::class, 'exitPages'])->name('dashboard.exit-pages');

    Route::get('/dashboard/statistics/referrers', [DashboardController::class, 'referrers'])->name('dashboard.referrers');
    Route::get('/dashboard/statistics/utm-sources', [DashboardController::class, 'utmSources'])->name('dashboard.utm-sources');
    Route::get('/dashboard/statistics/utm-mediums', [DashboardController::class, 'utmMediums'])->name('dashboard.utm-mediums');
    Route::get('/dashboard/statistics/utm-campaigns', [DashboardController::class, 'utmCampaigns'])->name('dashboard.utm-campaigns');
    Route::get('/dashboard/statistics/utm-contents', [DashboardController::class, 'utmContents'])->name('dashboard.utm-contents');
    Route::get('/dashboard/statistics/utm-terms', [DashboardController::class, 'utmTerms'])->name('dashboard.utm-terms');

    Route::get('/dashboard/statistics/browsers', [DashboardController::class, 'browsers'])->name('dashboard.browsers');
    Route::get('/dashboard/statistics/os', [DashboardController::class, 'os'])->name('dashboard.os');
    Route::get('/dashboard/statistics/devices', [DashboardController::class, 'devices'])->name('dashboard.devices');
    Route::get('/dashboard/statistics/screens', [DashboardController::class, 'screens'])->name('dashboard.screens');
    Route::get('/dashboard/statistics/languages', [DashboardController::class, 'languages'])->name('dashboard.languages');

    Route::get('/dashboard/statistics/countries', [DashboardController::class, 'countries'])->name('dashboard.countries');
    Route::get('/dashboard/statistics/regions', [DashboardController::class, 'regions'])->name('dashboard.regions');
    Route::get('/dashboard/statistics/cities', [DashboardController::class, 'cities'])->name('dashboard.cities');

    Route::get('/dashboard/chart', [DashboardController::class, 'loadChart'])->name('dashboard.load-chart');



    // websites
    Route::get('/websites/create', [WebsiteController::class, 'create'])->name('websites.create');
    Route::post('/websites', [WebsiteController::class, 'store'])->name('websites.store');
    Route::put('/websites', [WebsiteController::class, 'update'])->name('websites.update');
    Route::put('/websites/update-current', [WebsiteController::class, 'setCurrentWebsite'])->name('websites.update-current');

    // account
    Route::get('/account', [AccountController::class, 'edit'])->name('account.edit');
    Route::post('/account', [AccountController::class, 'update'])->name('account.update');
    Route::post('/account/update-password', [AccountController::class, 'updatePassword'])->name('account.update-password');
    Route::delete('/account', [AccountController::class, 'destroy'])->name('account.destroy');

    // billing
    Route::get('/pricing', [BillingController::class, 'pricing'])->name('billing.pricing');
    Route::get('/billing', [BillingController::class, 'index'])->name('billing.index');
    Route::get('/billing/redirect-to-portal', [BillingController::class, 'redirectToPortal'])->name('billing.redirect-to-portal');
    Route::post('/billing/generate-checkout-link', [BillingController::class, 'generateCheckoutLink'])->name('billing.generate-checkout-link');
});

require __DIR__.'/auth.php';
