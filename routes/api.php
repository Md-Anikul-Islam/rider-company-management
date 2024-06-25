<?php

use App\Http\Controllers\api\CarOrFleetController;
use App\Http\Controllers\api\DriverController;
use Illuminate\Http\Request;
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


});
