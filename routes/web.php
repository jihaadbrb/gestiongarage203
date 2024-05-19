<?php

use App\Models\SparePart;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\MechanicController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/welcome', function () {
    return
        view('welcome');
})->name('welcome');

Route::middleware(['auth', 'lang'])->group(function () {

    // dashboard
    Route::get('/', function () {
        return
            view('admin.dashboard');
    })->name('admin.dashboard');




    // USERS
    Route::get('/clients', [UserController::class, 'getUsers'])->middleware(['auth', 'verified'])->name('user.users');
    Route::post('/clients/store', [UserController::class, 'StoreUser'])->name('user.store');
    Route::put('/clients/{clientId}', [UserController::class, 'UpdateUser'])->name('user.update');
    Route::post('/clients/destroy', [UserController::class, 'DeleteUser'])->name('user.destroy');
    Route::post('/import-users', [UserController::class, 'importUsers'])->name('import.users');
    

    // VEHICLES
    Route::get('/vehicles', [VehicleController::class, 'getVehicles'])->name('admin.vehicles');
    Route::post('/vehicle/store', [VehicleController::class, 'CreateVehicle'])->name('admin.storeVehicle');
    Route::post('/vehicles/showVehiclePics', [VehicleController::class, 'showVehiclePics']);
    Route::put('/vehicles/{vehicleId}', [VehicleController::class, 'EditVehicle'])->name('admin.updateVehicle');
    Route::post('/vehicles/destroy', [VehicleController::class, 'DeleteVehicle'])->name('admin.destroyVehicle');
   



    // REPAIRS
    Route::get('/repairs', [RepairController::class, 'getRepairs'])->name('admin.repairs');
    Route::post('/repairs/store', [RepairController::class, 'CreateRepair'])->name('admin.storeRepair');
    Route::get('/getMechanics', [RepairController::class, 'MechanicsList'])->name('admin.fetchMechanics');
    Route::post('/repairs/destroy', [RepairController::class, 'DeleteRepair'])->name('admin.destroyRepair');
    Route::post('/repairs/update-status', [RepairController::class, 'RepairStatus'])->name('admin.updateRepairStatus');


    //INVOICES

    Route::post('/invoices/add', [InvoiceController::class, 'CreateInvoice'])->name('admin.generateInvoice');
    Route::get('/invoices', [InvoiceController::class, 'getInvoices'])->name('admin.Invoices');
    Route::post('/invoice/destroy', [InvoiceController::class, 'DeleteInvoice'])->name('admin.destroyInvoice');
    Route::post('/generate-pdf', [PDFController::class, 'generatePDF'])->name('invoice.generatePdf');



    
    // MECHANICS
    Route::get('/mechanics', [MechanicController::class, 'getMechanics'])->name('admin.mechanics');


    //SPARE PARTS
    Route::get('/spare-parts', [SparePartController::class, 'getSpareParts'])->name('admin.showSpares');
    Route::post('/spare-parts/add', [SparePartController::class, 'CreateSparePart'])->name('admin.storeSparePart');
    Route::post('/spare-parts/delete', [SparePartController::class, 'DeleteSparePart'])->name('admin.destroySparePart');



    // APPOINTEMENTS
    Route::get('/appointments', [AppointmentController::class, 'getAppointements'])->name('user.appointements');
    Route::post('/appointments/create', [AppointmentController::class, 'CreateAppointements'])->name('store.appointements');
    Route::post('/appointments/delete', [AppointmentController::class, 'DeleteAppointement'])->name('destroy.appointements');
    Route::post('/update-appointment-status', [AppointmentController::class, 'EditStatus'])->name('edit.status');

    // CHARTS
    Route::get('/', [ChartController::class, 'showCharts'])->name('admin.dashboard');
    Route::get('/admins', [ChartController::class, 'showAdmins'])->name('admin.admins')->middleware('admin');

 

   

    Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])->name('logout');
    Route::get('/changeLocale/{locale}', function ($locale) {
        session()->put('locale', $locale);
        return redirect()->back();
    })->name('products.changeLocale');

    // mails 
    Route::get('/send-mail', [MailController::class, 'index']);
    Route::get('/send-mails', [MailController::class, 'sendAll'])->name('admin.sendAll');
    Route::get('/mails', [MailController::class, 'showMails'])->name('admin.mails');

    Route::post('/send-email', [MailController::class, 'sendEmail'])->name('admin.sendEmail');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__ . '/auth.php';
