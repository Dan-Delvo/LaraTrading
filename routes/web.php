<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::inertia('/', 'Welcome', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
    Route::inertia('tradelog', 'TradeLog')->name('tradelogs');
    Route::inertia('tradesettings', 'TradeSettings')->name('tradesettings');
});

require __DIR__.'/settings.php';
