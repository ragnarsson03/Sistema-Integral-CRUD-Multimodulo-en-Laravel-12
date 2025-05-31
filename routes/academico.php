<?php

use App\Http\Controllers\Academico\EstudianteController;
use App\Http\Controllers\Academico\AsistenciaController;
use App\Http\Controllers\Academico\NotaController;
use App\Http\Controllers\Academico\CursoController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('estudiantes', EstudianteController::class);
    
    // Rutas para asistencias
    Route::resource('asistencias', AsistenciaController::class);
    
    // Rutas para notas
    Route::resource('notas', NotaController::class);
    
    // Rutas para cursos
    Route::resource('cursos', CursoController::class);
    
    // Agregar estas rutas específicas
    Route::get('notas/estudiante/{estudiante}', [NotaController::class, 'showEstudianteNotas'])
        ->name('notas.estudiante');
    Route::get('asistencias/estudiante/{estudiante}', [AsistenciaController::class, 'showEstudianteAsistencias'])
        ->name('asistencias.estudiante');
});
// Eliminar esta línea duplicada
// Route::resource('asistencias', AsistenciaController::class);