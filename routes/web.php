<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\LaptopController;
use App\Http\Controllers\CustomerController;

Route::get('/', [RentalController::class,'dashboard']);
Route::get('/pelanggan', [RentalController::class,'pelanggan']);
Route::get('/transaksi', [RentalController::class,'transaksi']);
Route::resource('laptops', LaptopController::class);
Route::resource('customers', CustomerController::class);
Route::resource('rentals', RentalController::class);
Route::put(
    '/rentals/{id}/return',
    [RentalController::class, 'returnLaptop']
)->name('rentals.return');
Route::get(
    '/laporan',
    [RentalController::class, 'laporan']
)->name('laporan');
Route::get(
    '/laporan/pdf',
    [RentalController::class, 'exportPdf']
)->name('laporan.pdf');