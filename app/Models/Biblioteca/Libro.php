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

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class);
    }

    public function actualizarCantidad($cantidad, $tipo)
    {
        if ($tipo === 'entrada') {
            $this->cantidad_disponible += $cantidad;
        } elseif ($tipo === 'salida' && $this->cantidad_disponible >= $cantidad) {
            $this->cantidad_disponible -= $cantidad;
        }
        return $this->save();
    }

    public function estaDisponible()
    {
        return $this->cantidad_disponible > 0;
    }
}