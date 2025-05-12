<?php

use App\Http\Controllers\Biblioteca\LibroController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('libros', LibroController::class);
});