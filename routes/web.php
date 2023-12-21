<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BikeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TestsEnrollmentController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\OrderController;
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

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'loginForm'])->name('login');
    Route::get('/register', [AuthController::class, 'registerForm']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/verification/{user}/{token}', [AuthController::class, 'verification']);
});

Route::middleware(['auth','verified'])->group(function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'role:admin||client'], function () {
    Route::resource('bikes', BikeController::class);
    Route::get('/logs', [LogController::class, 'index'])->name('logs');
});

Route::group(['middleware' => 'role:admin'], function () {
    Route::get('/logs', [LogController::class, 'index'])->name('logs');
});

Route::group(['middleware' => 'role:admin||client'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::post('/bikes/{bike}/buy', [BikeController::class, 'buy'])->name('bikes.buy');
