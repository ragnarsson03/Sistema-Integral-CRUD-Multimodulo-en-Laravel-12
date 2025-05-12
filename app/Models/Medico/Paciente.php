<?php

namespace App\Models\Medico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'fecha_nacimiento',
        'cedula',  // Cambiado de 'dni' a 'cedula' :)
        'genero',
        'direccion',
        'telefono',
        'email',
    ];
}
