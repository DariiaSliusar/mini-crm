<?php

use Illuminate\Support\Facades\Route;

Route::post('/tickets', [App\Http\Controllers\Api\TicketController::class, 'store'])
    ->name('api.tickets.store');

Route::get('/tickets/statistics', [App\Http\Controllers\Api\StatisticsController::class, 'statistics'])
    ->name('api.tickets.statistics');
