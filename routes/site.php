<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\TermController;
use App\Http\Controllers\Site\PrivacyController;
use App\Http\Controllers\Site\FaqController;
use App\Http\Controllers\Site\PricingController;

Route::get('/', [HomeController::class, 'index'])->name('site.home');
Route::get('/terms', [TermController::class, 'index'])->name('site.terms');
Route::get('/privacy', [PrivacyController::class, 'index'])->name('site.privacy');
Route::get('/faq', [FaqController::class, 'index'])->name('site.faq');
Route::get('/pricing', [PricingController::class, 'index'])->name('site.pricing');
