<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('layanans', LayananController::class)->except(['show']);
Route::resource('transaksis', TransaksiController::class);

// Handle favicon requests (both .ico and .png)
Route::get('/favicon.{ext}', function ($ext) {
    $file = public_path('favicon.ico');
    if (file_exists($file)) {
        return response()->file($file);
    }
    return response('', 204); // No content
})->where('ext', 'ico|png|jpg|jpeg');

// Handle robots.txt
Route::get('/robots.txt', function () {
    $file = public_path('robots.txt');
    if (file_exists($file)) {
        return response()->file($file);
    }
    return response('User-agent: *' . "\n" . 'Allow: /', 200, ['Content-Type' => 'text/plain']);
});
