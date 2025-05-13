<?php

namespace App\Models\Farmacia;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'medicamento_id',
        'cantidad',
        'motivo',
        'observaciones',
        'usuario_id',
    ];

    /**
     * Relación con el medicamento
     */
    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class);
    }

    /**
     * Relación con el usuario
     */
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope para filtrar por tipo de movimiento
     */
    public function scopeTipo($query, $tipo)
    {
        return $query->where('tipo', $tipo);
    }

    /**
     * Scope para filtrar por fecha
     */
    public function scopeFecha($query, $fecha_inicio, $fecha_fin)
    {
        return $query->whereBetween('created_at', [$fecha_inicio, $fecha_fin]);
    }

    /**
     * Scope para filtrar por medicamento
     */
    public function scopeMedicamento($query, $medicamento_id)
    {
        return $query->where('medicamento_id', $medicamento_id);
    }
}
