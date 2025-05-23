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
        'curso_id',  // Añadir curso_id a los campos rellenables!
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
    
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
}