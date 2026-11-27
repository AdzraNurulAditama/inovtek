<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MealPlannerController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// Halaman utama
Route::get('/', function () {
    return redirect()->route('dashboard');
});


// Halaman lain sementara memakai placeholder.
// Ganti satu per satu dengan controller aslinya saat halamannya dibuat.
foreach (['meal-planner', 'daftar-belanja', 'stok-dapur', 'scan-struk', 'anggaran', 'price-tracker', 'notifikasi', 'profil'] as $slug) {
    Route::get("/{$slug}", [PageController::class, 'show'])
        ->defaults('slug', $slug)
        ->name($slug);
}
Route::get('/meal-planner', [MealPlannerController::class, 'index'])->name('meal-planner');
Route::get('/meal-planner/resep', [MealPlannerController::class, 'showResep'])->name('meal-planner.resep');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

// Halaman Profil
Route::view('/profil', 'profile.index')
    ->name('profile');

// Halaman Price Tracker
Route::view('/price-tracker', 'price-tracker.index')
    ->name('price-tracker');

// Halaman Notifikasi
Route::view('/notifikasi', 'notifications.index')
    ->name('notifications');

// Halaman lain yang masih menggunakan placeholder
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

