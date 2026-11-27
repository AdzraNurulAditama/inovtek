
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MealPlannerController;
use App\Http\Controllers\PageController;

// Halaman utama
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

// Meal Planner menggunakan data dummy dari MealPlannerController
Route::get('/meal-planner', [MealPlannerController::class, 'index'])
    ->name('meal-planner');

// Detail Resep
Route::get('/meal-planner/resep', [MealPlannerController::class, 'showResep'])
    ->name('meal-planner.resep');

// Daftar Belanja (Frontend)
Route::view('/daftar-belanja', 'daftar-belanja.index')
    ->name('daftar-belanja');

// Halaman Stok Dapur
Route::get('/stok-dapur', [PageController::class, 'show'])
    ->defaults('slug', 'stok-dapur')
    ->name('stok-dapur');

// Halaman Anggaran
Route::get('/anggaran', [PageController::class, 'show'])
    ->defaults('slug', 'anggaran')
    ->name('anggaran');

// Halaman Scan Struk
Route::get('/scan-struk', [PageController::class, 'show'])
    ->defaults('slug', 'scan-struk')
    ->name('scan-struk');

// Halaman Price Tracker
Route::view('/price-tracker', 'price-tracker.index')
    ->name('price-tracker');

// Halaman Profil
Route::view('/profil', 'profile.index')
    ->name('profile');

// Halaman Notifikasi
Route::view('/notifikasi', 'notifications.index')
    ->name('notifications');
