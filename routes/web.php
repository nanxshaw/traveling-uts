<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TouristController;
use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\AccommodationOrderController;
use App\Http\Controllers\TouristOrderController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('tourists', TouristController::class);
Route::resource('accommodations', AccommodationController::class);
Route::resource('accommodation-orders', AccommodationOrderController::class);
Route::resource('tourist-orders', TouristOrderController::class);

