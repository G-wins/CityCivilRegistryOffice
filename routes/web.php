<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;

// Route para sa form
Route::get('/appointment', [AppointmentController::class, 'create']);

// Route para sa form submission
Route::post('/appointment', [AppointmentController::class, 'store']);

Route::get('/', function () {
    return view('welcome');
});
