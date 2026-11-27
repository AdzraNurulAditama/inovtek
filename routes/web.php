<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MealPlannerController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'));
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Halaman lain sementara memakai placeholder (PERHATIKAN: 'notifikasi' sudah dihapus dari sini)
foreach (['meal-planner', 'daftar-belanja', 'stok-dapur', 'scan-struk', 'anggaran', 'price-tracker', 'profil'] as $slug) {
    Route::get("/{$slug}", [PageController::class, 'show'])
        ->defaults('slug', $slug)
        ->name($slug);
}

// Route Meal Planner khusus Controller
Route::get('/meal-planner', [MealPlannerController::class, 'index'])->name('meal-planner');
Route::get('/meal-planner/resep', [MealPlannerController::class, 'showResep'])->name('meal-planner.resep');

// Halaman Profil
Route::view('/profil', 'profile.index')
    ->name('profile');

// Halaman Price Tracker
Route::view('/price-tracker', 'price-tracker.index')
    ->name('price-tracker');

// Halaman Notifikasi (Diubah namanya menjadi 'notifications' agar sesuai dengan tombol dashboard)
Route::view('/notifikasi', 'notifications.index')
    ->name('notifications');