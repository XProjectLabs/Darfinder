<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Owner Routes
Route::middleware(['auth', 'role:propriétaire'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Owner\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/stats', [App\Http\Controllers\Owner\DashboardController::class, 'stats'])->name('stats');
    Route::resource('properties', App\Http\Controllers\Owner\PropertyController::class);
    Route::delete('/properties/images/{image}', [App\Http\Controllers\Owner\PropertyController::class, 'deleteImage'])->name('properties.images.destroy');
    Route::post('/properties/images/{image}/primary', [App\Http\Controllers\Owner\PropertyController::class, 'setPrimaryImage'])->name('properties.images.primary');
    Route::get('/profile', [App\Http\Controllers\Owner\ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [App\Http\Controllers\Owner\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [App\Http\Controllers\Owner\ProfileController::class, 'updatePassword'])->name('profile.password');
});
