<?php

use App\Http\Controllers\api\CarOrFleetController;
use App\Http\Controllers\api\CouponController;use App\Http\Controllers\api\DriverController;
use App\Http\Controllers\api\PassengerController;use App\Http\Controllers\api\TripHistoryController;use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Driver Login
Route::post('driver-login', [DriverController::class, 'driverLogin']);
//passenger
Route::post('/passenger-register', [PassengerController::class, 'registerPassenger']);
Route::post('/passenger-login', [PassengerController::class, 'passengerLogin']);

//Auth routes
Route::group(['middleware' => 'auth:sanctum'], function () {

    //Driver Profile
    Route::get('driver-profile', [DriverController::class, 'driverProfile']);
    Route::post('driver-profile-update', [DriverController::class, 'driverProfileUpdate']);
    Route::post('assign-car-to-driver', [DriverController::class, 'assignCarToDriver']);
    //driver change password
    Route::post('driver-change-password', [DriverController::class, 'driverChangePassword']);

    //Car or Fleet routes
    Route::get('company-under-all-car-or-fleet',[CarOrFleetController::class, 'carOrFleetAll']);
    Route::get('company-under-unselected-car-or-fleet',[CarOrFleetController::class, 'carOrFleetUnselected']);

    //coupon
    Route::get('company-under-coupon-list', [CouponController::class, 'coupon']);

    //Passenger Profile
    Route::get('passenger-profile', [PassengerController::class, 'passengerProfile']);
    Route::post('passenger-profile-update', [PassengerController::class, 'updatePassengerProfile']);
    //Passenger change password
    Route::post('passenger-change-password', [PassengerController::class, 'passengerChangePassword']);

    //store trip history by driver
    Route::post('/trip-history-store', [TripHistoryController::class, 'storeTripHistory'])->name('trip.history.store');





});
