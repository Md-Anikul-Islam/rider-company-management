<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AgentController;use App\Http\Controllers\admin\CouponController;use App\Http\Controllers\admin\FleetTypeController;
use App\Http\Controllers\admin\PassengerController;use App\Http\Controllers\admin\TollController;
use App\Http\Controllers\admin\TripHistoryController;use App\Http\Controllers\company\CarOrFleetController;
use App\Http\Controllers\company\CompanyController;
use App\Http\Controllers\company\DriverController;
use App\Http\Controllers\company\TripController;use App\Http\Controllers\CompanyMakeController;use App\Http\Controllers\MessageController;use App\Http\Controllers\TripVerifyController;use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/get-specific-trip-history-verify/{encryptedId}', [TripVerifyController::class, 'driverSpecificTripHistory']);
Route::get('/message', [MessageController::class, 'index'])->name('message');
//company register
Route::get('/company-register', [CompanyMakeController::class, 'company'])->name('company.register');
Route::post('/company-register', [CompanyMakeController::class, 'companyRegister'])->name('company.register.store');

Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role == 'company') {
            return redirect()->route('company.dashboard');
        }
    }
    return view('auth.login');
})->name('home');



Route::middleware(['auth'])->group(function () {
    Route::middleware(['admin'])->prefix('admin')->group(function () {

        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        //company routes
        Route::get('/company', [App\Http\Controllers\admin\CompanyController::class, 'index'])->name('admin.company');
        Route::get('/company/details/{companyId}', [App\Http\Controllers\admin\CompanyController::class, 'showCompanyDetails'])->name('admin.company.details.show');
        Route::post('/company/store', [App\Http\Controllers\admin\CompanyController::class, 'store'])->name('admin.company.store');
        Route::put('/company/update/{id}', [App\Http\Controllers\admin\CompanyController::class, 'update'])->name('admin.company.update');
        Route::get('/company/delete/{id}', [App\Http\Controllers\admin\CompanyController::class, 'destroy'])->name('admin.company.delete');
        Route::get('/company/driver/list/{companyId}', [App\Http\Controllers\admin\CompanyController::class, 'showDriverList'])->name('admin.company.under.driver.list');
        Route::get('/company/driver/details/{id}', [App\Http\Controllers\admin\CompanyController::class, 'showDriverDetails'])->name('admin.company.under.driver.details');

        //fleet type routes
        Route::get('/fleetType', [FleetTypeController::class, 'index'])->name('admin.fleetType');
        Route::post('/fleetType/store', [FleetTypeController::class, 'store'])->name('admin.fleetType.store');
        Route::put('/fleetType/update/{id}', [FleetTypeController::class, 'update'])->name('admin.fleetType.update');
        Route::get('/fleetType/delete/{id}', [FleetTypeController::class, 'destroy'])->name('admin.fleetType.delete');

        //fleet type routes
        Route::get('/toll', [TollController::class, 'index'])->name('admin.toll');
        Route::post('/toll/store', [TollController::class, 'store'])->name('admin.toll.store');
        Route::put('/toll/update/{id}', [TollController::class, 'update'])->name('admin.toll.update');
        Route::get('/toll/delete/{id}', [TollController::class, 'destroy'])->name('admin.toll.delete');

        //passenger
        Route::get('/passenger', [PassengerController::class, 'index'])->name('admin.passenger');

        //trip history
        Route::get('/trip-history', [TripHistoryController::class, 'allTripHistory'])->name('admin.all.trip.history');
        Route::get('/request-trip-history', [TripHistoryController::class, 'requestTripHistory'])->name('admin.request.trip.history');
        Route::get('/manual-trip-history', [TripHistoryController::class, 'manualTripHistory'])->name('admin.manual.trip.history');

        //agent type routes
        Route::get('/agent', [AgentController::class, 'index'])->name('admin.agent');
        Route::post('/agent/store', [AgentController::class, 'store'])->name('admin.agent.store');
        Route::put('/agent/update/{id}', [AgentController::class, 'update'])->name('admin.agent.update');
        Route::get('/agent/delete/{id}', [AgentController::class, 'destroy'])->name('admin.agent.delete');

        //coupon
        Route::get('/coupon', [CouponController::class, 'index'])->name('admin.coupon');
        Route::post('/coupon/store', [CouponController::class, 'store'])->name('admin.coupon.store');
        Route::put('/coupon/update/{id}', [CouponController::class, 'update'])->name('admin.coupon.update');
        Route::get('/coupon/delete/{id}', [CouponController::class, 'destroy'])->name('admin.coupon.delete');
    });

    Route::middleware(['company'])->prefix('company')->group(function () {
        Route::get('/dashboard', [CompanyController::class, 'index'])->name('company.dashboard');

        //fleet or car routes
        Route::get('/car', [CarOrFleetController::class, 'index'])->name('company.car');
        Route::post('/car/store', [CarOrFleetController::class, 'store'])->name('company.car.store');
        Route::put('/car/update/{id}', [CarOrFleetController::class, 'update'])->name('company.car.update');
        Route::get('/car/delete/{id}', [CarOrFleetController::class, 'destroy'])->name('company.car.delete');

        //fleet or car routes
        Route::get('/driver', [DriverController::class, 'index'])->name('company.driver');
        Route::post('/driver/store', [DriverController::class, 'store'])->name('company.driver.store');
        Route::get('/driver/details/{id}', [DriverController::class, 'show'])->name('company.driver.details.show');
        Route::put('/driver/update/{id}', [DriverController::class, 'update'])->name('company.driver.update');
        Route::get('/driver/delete/{id}', [DriverController::class, 'destroy'])->name('company.driver.delete');

        //trip history
        Route::get('/trip', [TripController::class, 'allTripHistoryUnderCompany'])->name('company.trip');
        Route::get('/request-trip', [TripController::class, 'requestTripHistoryUnderCompany'])->name('company.request.trip');
        Route::get('/manual-trip', [TripController::class, 'manualTripHistoryUnderCompany'])->name('company.manual.trip');



    });
});

require __DIR__.'/auth.php';
