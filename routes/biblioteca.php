<?php

use App\Http\Controllers\Biblioteca\LibroController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('libros', LibroController::class);
});

// Añadir esta ruta junto con las demás rutas de biblioteca
Route::get('/libros/check-isbn', [LibroController::class, 'checkIsbn'])->name('biblioteca.libros.check-isbn');