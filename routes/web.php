<?php

use App\Http\Controllers\TradeSettingsController;
use Illuminate\Support\Facades\Route;


Route::inertia('/', 'auth/Login')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
    Route::inertia('tradelog', 'TradeLog')->name('tradelogs');

    Route::prefix('tradesettings')->group(function () {
        Route::get('/', [TradeSettingsController::class, 'index'])->name('tradesettings.index');
        Route::post('/', [TradeSettingsController::class, 'store'])->name('tradesettings.store');
    });
    
});


require __DIR__.'/settings.php';
