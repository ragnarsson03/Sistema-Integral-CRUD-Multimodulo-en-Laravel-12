<?php

use App\Http\Controllers\Academico\EstudianteController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('estudiantes', EstudianteController::class);
});