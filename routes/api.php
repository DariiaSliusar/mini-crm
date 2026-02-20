<?php

use Illuminate\Support\Facades\Route;

Route::post('/tickets', [App\Http\Controllers\Api\TicketController::class, 'store'])->name('api.tickets.store');

