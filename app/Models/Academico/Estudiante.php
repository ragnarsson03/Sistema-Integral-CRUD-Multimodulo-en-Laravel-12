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
        'cedula',
        'grado',
    ];
    
    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];
    
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }
    
    public function notas()
    {
        return $this->hasMany(Nota::class);
    }
}