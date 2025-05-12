<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Ruta principal - Dashboard
Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Rutas de autenticación
require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de autenticación (login, registro, etc.)
require __DIR__.'/auth.php';
