<?php

use App\Http\Controllers\Farmacia\MedicamentoController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('medicamentos', MedicamentoController::class);
});