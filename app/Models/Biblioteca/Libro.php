<?php

namespace App\Models\Biblioteca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'titulo',
        'autor',
        'editorial',
        'isbn',
        'anio_publicacion',
        'cantidad_disponible',
        'categoria',
        'descripcion',
    ];
    
    protected $casts = [
        'anio_publicacion' => 'integer',
        'cantidad_disponible' => 'integer',
    ];
}