<?php

use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\TicketsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/settings.php';

Route::get('/widget', function () {
    return view('widget');
})->name('widget');

Route::middleware(['auth', 'verified', 'role:manager'])->group(function () {
    Route::get('/tickets', [TicketsController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{ticket}', [TicketsController::class, 'show'])->name('tickets.show');
    Route::get('/media/{media}/download', [MediaController::class, 'download'])->name('media.download');
});
