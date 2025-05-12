<?php

namespace App\Models\Medico;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';
    
    protected $fillable = [
        'paciente_id',
        'medico_id',
        'fecha_hora',
        'estado',
        'motivo',
        'notas',
    ];

    protected $casts = [
        'fecha_hora' => 'datetime',
    ];

    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class);
    }

    public function medico(): BelongsTo
    {
        return $this->belongsTo(User::class, 'medico_id');
    }
}