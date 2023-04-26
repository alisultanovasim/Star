<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[\App\Http\Controllers\BookingController::class,'index']);
Route::post('/booking',[\App\Http\Controllers\BookingController::class,'book'])->name('booking');
Route::post('/message',[\App\Http\Controllers\BookingController::class,'message'])->name('message');
