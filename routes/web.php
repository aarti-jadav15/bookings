<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('/',[AuthController::class,'RegisterForm']);
Route::post('/registerstore',[AuthController::class,'RegisterStore']);
Route::get('loginform',[AuthController::class,'LoginForm'])->name('login');
Route::post('login',[AuthController::class,'Login']);
Route::get('/verify-email/{token}', [AuthController::class, 'VerifyEmail'])->name('verification.verify');
Route::post('/logout', [AuthController::class, 'Logout'])->name('logout');


Route::get('dashboard',[AuthController::class,'Dashboard'])->middleware('auth')->name('dashboard');
Route::post('store_bookings',[AuthController::class,'StoreBookings'])->middleware('auth');

