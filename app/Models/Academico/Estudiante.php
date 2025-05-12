<?php

namespace App\Models\Academico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nombre',
        'apellido',
        'fecha_nacimiento',
        'dni',
        'grado',
    ];
    
    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];
}