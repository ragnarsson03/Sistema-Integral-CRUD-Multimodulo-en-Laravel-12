<?php

namespace App\Models\Academico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'estudiante_id',
        'fecha',
        'estado', // presente, ausente, tardanza
        'observaciones',
    ];
    
    protected $casts = [
        'fecha' => 'date',
    ];
    
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }
}