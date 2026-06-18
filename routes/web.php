<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', [
    DashboardController::class,
    'index'
]);

Route::post('/transaksi', [
    DashboardController::class,
    'store'
]);
Route::get('/test', function () {
    return App\Models\Layanan::count();
});