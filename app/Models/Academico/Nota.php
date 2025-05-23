<?php

namespace App\Models\Academico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'estudiante_id',
        'curso_id',      // Cambiado de 'asignatura'
        'calificacion',
        'periodo',
        'fecha_evaluacion',
        'observaciones',
    ];
    
    protected $casts = [
        'fecha_evaluacion' => 'date',
    ];
    
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
}