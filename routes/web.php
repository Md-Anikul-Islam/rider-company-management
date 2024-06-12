<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\company\CompanyController;
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

    });

    Route::middleware(['company'])->prefix('company')->group(function () {
        Route::get('/dashboard', [CompanyController::class, 'index'])->name('company.dashboard');
    });
});

require __DIR__.'/auth.php';
