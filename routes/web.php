<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\FleetTypeController;use App\Http\Controllers\admin\TollController;use App\Http\Controllers\company\CarOrFleetController;use App\Http\Controllers\company\CompanyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
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

//Route::get('/', function () {
//    return view('auth.login');
//});
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
        Route::post('/company/store', [App\Http\Controllers\admin\CompanyController::class, 'store'])->name('admin.company.store');
        Route::put('/company/update/{id}', [App\Http\Controllers\admin\CompanyController::class, 'update'])->name('admin.company.update');
        Route::get('/company/delete/{id}', [App\Http\Controllers\admin\CompanyController::class, 'destroy'])->name('admin.company.delete');

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

    });

    Route::middleware(['company'])->prefix('company')->group(function () {
        Route::get('/dashboard', [CompanyController::class, 'index'])->name('company.dashboard');

        //fleet or car routes
        Route::get('/car', [CarOrFleetController::class, 'index'])->name('company.car');
        Route::post('/car/store', [CarOrFleetController::class, 'store'])->name('company.car.store');
        Route::put('/car/update/{id}', [CarOrFleetController::class, 'update'])->name('company.car.update');
        Route::get('/car/delete/{id}', [CarOrFleetController::class, 'destroy'])->name('company.car.delete');

    });
});

require __DIR__.'/auth.php';
