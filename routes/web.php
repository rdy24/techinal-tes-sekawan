<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MineController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\VehicleController;
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

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout']);

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.','middleware' => ['auth', 'checkRole:admin']], function () {

    Route::resource('/mines', MineController::class);
    Route::resource('/companies', CompanyController::class);
    Route::resource('/drivers', DriverController::class);
    Route::resource('/vehicles', VehicleController::class);

});

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => ['auth', 'checkRole:admin,supervisor,manager']], function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/orders/export', [OrderController::class, 'export'])->name('orders.export');
    Route::resource('/orders', OrderController::class);
    Route::get('/orders/{order}/approve', [OrderController::class, 'approve'])->name('orders.approve');
    Route::get('/orders/{order}/reject', [OrderController::class, 'reject'])->name('orders.reject');
});
