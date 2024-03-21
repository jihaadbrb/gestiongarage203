<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.dashboard');
    Route::delete('/dashboard/{client}/destroy', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('/dashboard/{client}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/dashboard/{client}/update', [AdminController::class, 'update'])->name('admin.update');
    Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/profile/{client}', [AdminController::class, 'showProfile'])->name('admin.show-profile');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});





require __DIR__ . '/auth.php';
