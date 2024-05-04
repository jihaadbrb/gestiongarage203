<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\VehicleController;
use App\Models\SparePart;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth','lang'])->group(function () {
    
    Route::get('/',function(){
        return 
            view('admin.dashboard');
    })->name('admin.dashboard');


    Route::get('/',[ChartController::class,'showCharts'])->name('admin.dashboard');

    Route::get('/admins',[AdminController::class , 'showAdmins'])->name('admin.admins');


    // Users
    Route::get('/users', [AdminController::class, 'showUsers'])->middleware(['auth', 'verified'])->name('admin.users');
    Route::put('/users/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::post('/users/showModal',[AdminController::class,'showModal'])->name('users.showModal');
    Route::post('/users/destroy', [AdminController::class, 'destroy'])->name('admin.destroy');


    // Mechanics
    Route::get('/mechanics',[AdminController::class , 'showMechanics'])->name('admin.mechanics');
    Route::post('/mechanics/showModalMechanic',[AdminController::class,'showModalMechanic'])->name('admin.showModalMechanic');
    // Route::get('/',[AdminController::class,'mechanicsInfo'])->name('admin.mechanicsInfo');
    

    // Vehicles
    Route::get('/vehicles',[VehicleController::class,'showVehicles'])->name('admin.vehicles');
    Route::post('/vehicle/store',[VehicleController::class,'storeVehicle'])->name('admin.storeVehicle');
    Route::post('/vehicles/showVehiclePics', [VehicleController::class, 'showVehiclePics']);
    Route::put('/vehicles/{id}', [VehicleController::class, 'updateVehicle'])->name('admin.updateVehicle');
    Route::post('/vehicles/destroy', [VehicleController::class, 'destroyVehicle'])->name('admin.destroyVehicle');


    //Repairs
    Route::get('/repairs',[RepairController::class,'showRepairs'])->name('admin.repairs');
    Route::post('/repairs/store',[RepairController::class,'storeRepair'])->name('admin.storeRepair');
    Route::get('/getMechanics',[RepairController::class,'fetchMechanics'])->name('admin.fetchMechanics');
    Route::post('/repairs/destroy', [RepairController::class, 'destroyRepair'])->name('admin.destroyRepair');
    Route::post('/repairs/update-status',[RepairController::class , 'updateRepairStatus'])->name('admin.updateRepairStatus');


    //invoice

    Route::post('/invoices/generate',[InvoiceController::class ,'generateInvoice'])->name('admin.generateInvoice');
    Route::get('/invoices',[InvoiceController::class,'showInvoices'])->name('admin.Invoices');
    Route::post('/invoices/showModal',[InvoiceController::class,'showInvoiceModal'])->name('admin.showInvoiceModal');
    Route::post('/invoice/destroy', [InvoiceController::class, 'destroyInvoice'])->name('admin.destroyInvoice');

    Route::post('/generate-pdf', [PDFController::class, 'generatePDF'])->name('invoice.generatePdf');

    //spare parts
    Route::get('/spare-parts',[SparePartController::class,'showSpareParts'])->name('admin.showSpares');
    Route::post('/spare-parts/add', [SparePartController::class, 'addSparePart'])->name('admin.storeSparePart');
    Route::post('/spare-parts/delete', [SparePartController::class, 'destroySparePart'])->name('admin.destroySparePart');

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
