<?php

namespace App\Models\Academico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'codigo',
        'descripcion',
        'profesor_id',
        'nivel',
        'activo'
    ];

    /**
     * Relación con estudiantes
     */
    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class);
    }

    /**
     * Relación con asistencias
     */
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }

    /**
     * Relación con el profesor
     */
    public function profesor()
    {
        return $this->belongsTo(User::class, 'profesor_id');
    }
}
