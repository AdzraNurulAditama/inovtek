<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MealPlannerController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'));
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Halaman lain sementara memakai placeholder.
// Ganti satu per satu dengan controller aslinya saat halamannya dibuat.
foreach (['meal-planner', 'daftar-belanja', 'stok-dapur', 'scan-struk', 'anggaran', 'price-tracker', 'notifikasi', 'profil'] as $slug) {
    Route::get("/{$slug}", [PageController::class, 'show'])
        ->defaults('slug', $slug)
        ->name($slug);
}
Route::get('/meal-planner', [MealPlannerController::class, 'index'])->name('meal-planner');