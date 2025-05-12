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

// Rutas para el módulo de farmacia - Movimientos de Inventario
Route::prefix('farmacia')->name('farmacia.')->group(function () {
    // Dashboard de inventario
    Route::get('/dashboard', [App\Http\Controllers\Farmacia\MovimientoInventarioController::class, 'dashboard'])
        ->name('dashboard');
        
    // Movimientos de inventario
    Route::get('/movimientos', [App\Http\Controllers\Farmacia\MovimientoInventarioController::class, 'index'])
        ->name('movimientos.index');
        
    // Entradas
    Route::get('/movimientos/entrada/crear', [App\Http\Controllers\Farmacia\MovimientoInventarioController::class, 'createEntrada'])
        ->name('movimientos.entrada.create');
    Route::post('/movimientos/entrada', [App\Http\Controllers\Farmacia\MovimientoInventarioController::class, 'storeEntrada'])
        ->name('movimientos.entrada.store');
        
    // Salidas
    Route::get('/movimientos/salida/crear', [App\Http\Controllers\Farmacia\MovimientoInventarioController::class, 'createSalida'])
        ->name('movimientos.salida.create');
    Route::post('/movimientos/salida', [App\Http\Controllers\Farmacia\MovimientoInventarioController::class, 'storeSalida'])
        ->name('movimientos.salida.store');
});


