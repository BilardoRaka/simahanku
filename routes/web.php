<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PreorderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\UserController;
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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/preorder/{id}/confirm', [PreorderController::class, 'confirm'])->middleware('auth');

// Authentification Route
Route::get('/signin', [AuthController::class, 'signin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::get('/registration', [AuthController::class, 'registration'])->middleware('guest');
Route::post('/registration', [AuthController::class, 'storeRegistration'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout']);

// Resource Route
Route::resource('/user', UserController::class)->except('show')->middleware('auth');
Route::resource('/customer', CustomerController::class)->except('show')->middleware('auth');
Route::resource('/supplier', SupplierController::class)->except('show')->middleware('auth');
Route::resource('/material', MaterialController::class)->except('show')->middleware('auth');
Route::resource('/supply', SupplyController::class)->except('show','edit','update','destroy')->middleware('auth');
Route::resource('/product', ProductController::class)->except('show')->middleware('auth');
Route::resource('/type', ProductTypeController::class)->except('show')->middleware('auth');
Route::resource('/preorder', PreorderController::class)->except('show','edit','update')->middleware('auth');

// PDF Route
Route::get('/material/pdf', [MaterialController::class, 'pdf'])->middleware('auth');
Route::get('/preorder/{id}/pdf', [PreorderController::class, 'pdf'])->middleware('auth');

// payment
Route::get('/preorder/{id}/payment/page', [PreorderController::class, 'paymentPage'])->middleware('auth');
Route::put('/preorder/{id}/payment/post', [PreorderController::class, 'paymentPost'])->middleware('auth');
Route::get('/preorder/{session_id}/payment/notification', [PreorderController::class, 'paymentNotification'])->name('preorder.notification')->middleware('auth');
