<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Medico\PacienteController;
use Illuminate\Support\Facades\Route;

// Ruta principal - Sin middleware de autenticación
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Ruta del dashboard (requiere autenticación)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rutas del módulo médico
    Route::name('medico.')->prefix('medico')->group(function () {
        Route::resource('pacientes', PacienteController::class);
    });
    
    // Rutas del módulo farmacia
    Route::name('farmacia.')->prefix('farmacia')->group(function () {
        require __DIR__.'/farmacia.php';
    });
    
    // Rutas del módulo académico
    Route::name('academico.')->prefix('academico')->group(function () {
        require __DIR__.'/academico.php';
    });
    
    // Rutas del módulo biblioteca
    Route::name('biblioteca.')->prefix('biblioteca')->group(function () {
        require __DIR__.'/biblioteca.php';
    });
    
    // Rutas del módulo comedor
    Route::name('comedor.')->prefix('comedor')->group(function () {
        require __DIR__.'/comedor.php';
    });
    
    // Rutas del módulo usuarios - Sin prefijo de nombre
    Route::prefix('admin')->group(function () {
        require __DIR__.'/usuarios.php';
    });
});

// Rutas de autenticación (login, registro, etc.)
require __DIR__.'/auth.php';


