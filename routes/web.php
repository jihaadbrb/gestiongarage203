<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth','lang'])->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/admins',[AdminController::class , 'showAdmins'])->name('admin.admins');
    

    // Users
    Route::get('/users', [AdminController::class, 'showUsers'])->middleware(['auth', 'verified'])->name('admin.users');
    Route::put('/users/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::post('/users/showModal',[AdminController::class,'showModal'])->name('users.showModal');
    Route::post('/users/destroy', [AdminController::class, 'destroy'])->name('admin.destroy');


    // Mechanics
    Route::get('/mechanics',[AdminController::class , 'showMechanics'])->name('admin.mechanics');
    Route::post('/mechanics/showModalMechanic',[AdminController::class,'showModalMechanic'])->name('admin.showModalMechanic');

    // Vehicles 
    Route::get('/vehicles',[AdminController::class,'showVehicles'])->name('admin.vehicles');
    Route::post('/vehicle/store',[AdminController::class,'storeVehicle'])->name('admin.storeVehicle');
    Route::post('/vehicles/showVehiclePics', [AdminController::class, 'showVehiclePics']);
    Route::put('/vehicles/{id}', [AdminController::class, 'updateVehicle'])->name('admin.updateVehicle');

    Route::post('/store', [AdminController::class, 'store'])->name('admin.store');
    Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])->name('logout');
    Route::get('/changeLocale/{locale}',function($locale){
        session()->put('locale',$locale);
        return redirect()->back();
    })->name('products.changeLocale');


});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__ . '/auth.php';
