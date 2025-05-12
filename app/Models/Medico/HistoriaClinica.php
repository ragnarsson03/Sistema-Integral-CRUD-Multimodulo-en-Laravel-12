<?php

namespace App\Models\Medico;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoriaClinica extends Model
{
    use HasFactory;

    protected $table = 'historias_clinicas';
    
    protected $fillable = [
        'paciente_id',
        'fecha',
        'diagnostico',
        'tratamiento',
        'observaciones',
        'medico_id',
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