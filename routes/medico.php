<?php

use App\Http\Controllers\Medico\PacienteController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('pacientes', PacienteController::class);
});