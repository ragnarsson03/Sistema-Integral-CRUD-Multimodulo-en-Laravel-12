<?php

use App\Http\Controllers\Comedor\TarjetaController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('tarjetas', TarjetaController::class);
});