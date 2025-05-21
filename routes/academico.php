<?php

use App\Http\Controllers\Academico\EstudianteController;
use App\Http\Controllers\Academico\AsistenciaController;
use App\Http\Controllers\Academico\NotaController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('estudiantes', EstudianteController::class);
    
    // Rutas para asistencias
    Route::resource('asistencias', AsistenciaController::class);
    
    // Rutas para notas
    Route::resource('notas', NotaController::class);
    
    // Agregar estas rutas específicas
    Route::get('notas/estudiante/{estudiante}', [NotaController::class, 'showEstudianteNotas'])
        ->name('notas.estudiante');
    Route::get('asistencias/estudiante/{estudiante}', [AsistenciaController::class, 'showEstudianteAsistencias'])
        ->name('asistencias.estudiante');
});