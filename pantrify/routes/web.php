<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::view('/price-tracker', 'price-tracker.index')
    ->name('price-tracker');

Route::view('/notifikasi', 'notifications.index')
    ->name('notifications');

Route::view('/profil', 'profile.index')
    ->name('profile');

Route::get('/meal-planner', [PageController::class, 'show'])
    ->defaults('slug', 'meal-planner')
    ->name('meal-planner');

Route::get('/daftar-belanja', [PageController::class, 'show'])
    ->defaults('slug', 'daftar-belanja')
    ->name('daftar-belanja');

Route::get('/stok-dapur', [PageController::class, 'show'])
    ->defaults('slug', 'stok-dapur')
    ->name('stok-dapur');

Route::get('/scan-struk', [PageController::class, 'show'])
    ->defaults('slug', 'scan-struk')
    ->name('scan-struk');

Route::get('/anggaran', [PageController::class, 'show'])
    ->defaults('slug', 'anggaran')
    ->name('anggaran');