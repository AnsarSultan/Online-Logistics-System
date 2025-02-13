<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserFreightController;
use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('welcome');
    // $ipAddress = request()->ip();
    // dd($ipAddress);

})->name('home.page');

// Route::view('rate-calculator', 'rateCalculator')->name('rate.calculator');
Route::view('track-shipments', 'trackShipments')->name('track.shipments');
Route::view('contact-us', 'contactUs')->name('contact.us');
Route::view('about-us', 'aboutUS')->name('about.us');



Route::match(['get', 'post'], '/auth/{action}', [AuthController::class, 'handleAuth'])->name('auth');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('rate-calculator', [UserFreightController::class, 'showCalculator'])->name('rate.calculator');

Route::post('/track-shipments', [UserFreightController::class, 'trackShipment'])->name('track.Shipment');

Route::post('/getFreightPrice', [UserFreightController::class, 'getFreightPrice'])->name('getFreightPrice');
Route::get('/get-destinations/{origin}', [UserFreightController::class, 'getDestinations'])->name('getDestinations');

Route::middleware(['validate:user'])->group(function () {
   
    Route::post('/freight-booking', [UserFreightController::class, 'checkPrice'])->name('checkPrice');
    Route::post('/freight-booking', [UserFreightController::class, 'bookFreight'])->name('freightBooking');
    Route::get('/freight-booking', [UserFreightController::class, 'showFreightForm'])->name('freightBooking');
    Route::get('payments', [UserFreightController::class, 'showPayments'])->name('payments');
    Route::post('payments/{freightID}', [UserFreightController::class, 'doPayment'])->name('doPayments');
    Route::delete('/freight/cancel/{freightID}', [UserFreightController::class, 'cancelFreight'])->name('freight.cancel');
});

Route::middleware(['validate:admin'])->group(function () {


    Route::view('generate-report', 'report')->name('generate.report');
    Route::view('admin-dashboard', 'dashboard')->name('admin.dashboard');

    Route::post('generate-report', [AdminDashboardController::class, 'generateReport'])->name('report.generate');


    Route::get('/admin-dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin-panel', [AdminDashboardController::class, 'showPendingFreights'])->name('admin.panel');
    Route::get('/delivered-freights', [AdminDashboardController::class, 'showDeliveredFreights'])->name('delivered.freights');
    Route::get('/edit-freight/{id}', [AdminDashboardController::class, 'editFreights'])->name('edit.freight');
    Route::post('/update-freight/{id}', [AdminDashboardController::class, 'updateFreights'])->name('update.freight');
    Route::get('/freights-by-status/{statusId}', [AdminDashboardController::class, 'getFreightsByStatus'])->name('freights.byStatus');
    Route::get('/freights/all', [AdminDashboardController::class, 'getAllFreights'])->name('freights.all');


    Route::get('/add-trip', [AdminDashboardController::class, 'addTrips'])->name('add.trip');
    Route::post('/add-trip', [AdminDashboardController::class, 'storeTrips'])->name('store.trip');
    Route::get('/manage-trips', [AdminDashboardController::class, 'showTrips'])->name('manage.trips');
    Route::delete('/manage-trips/{id}', [AdminDashboardController::class, 'deleteTrip'])->name('trips.delete');
    Route::get('/edit-trips/{id}', [AdminDashboardController::class, 'editTrip'])->name('trips.edit');
    Route::put('/update-trips/{id}', [AdminDashboardController::class, 'updateTrip'])->name('trips.update');



    Route::get('/add-expense', [AdminDashboardController::class, 'addExpense'])->name('add.expense');
    Route::post('/add-expense', [AdminDashboardController::class, 'storeExpense'])->name('store.expense');
    Route::get('/manage-expense', [AdminDashboardController::class, 'showExpense'])->name('manage.expense');
    Route::delete('/manage-expense/{id}', [AdminDashboardController::class, 'deleteExpense'])->name('delete.expense');
    Route::get('/manage-trips/{id}', [AdminDashboardController::class, 'editExpense'])->name('edit.expense');
    Route::put('/manage-trips/{id}', [AdminDashboardController::class, 'updateExpense'])->name('update.expense');


    Route::get('/add-income', [AdminDashboardController::class, 'incomeForm'])->name('add.income');
    Route::post('/add-income', [AdminDashboardController::class, 'storeIncome'])->name('store.income');
    Route::get('/manage-income', [AdminDashboardController::class, 'showIncome'])->name('manage.income');
    Route::delete('/manage-income/{id}', [AdminDashboardController::class, 'deleteIncome'])->name('delete.income');
    Route::get('/manage-income/{id}', [AdminDashboardController::class, 'editIncome'])->name('edit.income');
    Route::put('/manage-income/{id}', [AdminDashboardController::class, 'updateIncome'])->name('update.income');



    Route::get('/add-driver', [AdminDashboardController::class, 'driverForm'])->name('add.driver');
    Route::post('/add-driver', [AdminDashboardController::class, 'storeDriver'])->name('store.driver');
    Route::get('/manage-driver', [AdminDashboardController::class, 'showDriver'])->name('manage.driver');
    Route::delete('/manage-driver/{id}', [AdminDashboardController::class, 'deleteDriver'])->name('delete.driver');
    Route::get('/edit-driver{id}', [AdminDashboardController::class, 'editDriver'])->name('edit.driver');
    Route::put('/update-driver{id}', [AdminDashboardController::class, 'updateDriver'])->name('update.driver');


    Route::get('/add-vehicle', [AdminDashboardController::class, 'showVehicleForm'])->name('add.vehicle');
    Route::get('/manage-vehicle', [AdminDashboardController::class, 'showVehicles'])->name('manage.vehicle');
    Route::post('/add-vehicle', [AdminDashboardController::class, 'storeVehicle'])->name('store.vehicle');
    Route::delete('/manage-vehicle/{id}', [AdminDashboardController::class, 'deleteVehicles'])->name('delete.vehicle');
    Route::get('/manage-vehicle/{id}', [AdminDashboardController::class, 'editVehicle'])->name('edit.vehicle');
    Route::put('/manage-vehicle/{id}', [AdminDashboardController::class, 'updateVehicle'])->name('update.vehicle');

    Route::get('/admin/manage-locations', [AdminDashboardController::class, 'showLocations'])->name('locations');
    Route::get('/admin/manage-locations/create', [AdminDashboardController::class, 'createLocation'])->name('locations.create');
    Route::post('/admin/manage-locations', [AdminDashboardController::class, 'storeLocation'])->name('locations.store');
    Route::get('/admin/manage-locations/{id}/edit', [AdminDashboardController::class, 'editLocation'])->name('locations.edit');
    Route::put('/admin/manage-locations/{id}', [AdminDashboardController::class, 'updateLocation'])->name('locations.update');
    Route::delete('/admin/manage-locations/{id}', [AdminDashboardController::class, 'destroyLocation'])->name('locations.destroy');
});
