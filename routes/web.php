<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::get('/', function () {
    $properties = \App\Models\Property::with(['city', 'images'])->where('status', 'active')
        ->latest()
        ->take(6)
        ->get();
    return view('welcome', compact('properties'));
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
// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class)->except(['show']);
    Route::resource('cities', App\Http\Controllers\Admin\CityController::class)->except(['show']);
    Route::resource('users', App\Http\Controllers\Admin\UserController::class)->only(['index', 'show', 'destroy']);
    Route::post('/users/{user}/toggle-status', [App\Http\Controllers\Admin\UserController::class, 'toggleStatus'])->name('users.toggle-status');

    Route::resource('properties', App\Http\Controllers\Admin\PropertyController::class)->only(['index', 'show']);
    Route::post('/properties/{property}/approve', [App\Http\Controllers\Admin\PropertyController::class, 'approve'])->name('properties.approve');
    Route::post('/properties/{property}/reject', [App\Http\Controllers\Admin\PropertyController::class, 'reject'])->name('properties.reject');
});
