<?php

namespace App\Models\Farmacia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoInventario extends Model
{
    use HasFactory;

    protected $table = 'movimientos_inventario';

    protected $fillable = [
        'medicamento_id',
        'tipo_movimiento', // 'entrada' o 'salida'
        'cantidad',
        'motivo', // 'compra', 'venta', 'caducidad', etc.
        'fecha_movimiento',
        'usuario_id', // quien registró el movimiento
        'observaciones'
    ];

    protected $casts = [
        'fecha_movimiento' => 'datetime',
    ];

    // Relación con el medicamento
    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class);
    }

    // Relación con el usuario
    public function usuario()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}