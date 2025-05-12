<?php

namespace App\Models\Comedor;

use App\Models\Academico\Estudiante;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarjeta extends Model
{
    use HasFactory;
    
    protected $table = 'tarjetas_comedor';
    
    protected $fillable = [
        'codigo',
        'estudiante_id',
        'saldo',
        'activa',
    ];
    
    protected $casts = [
        'saldo' => 'decimal:2',
        'activa' => 'boolean',
    ];
    
    /**
     * Obtiene el estudiante asociado a esta tarjeta.
     */
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }
    
    /**
     * Obtiene las transacciones asociadas a esta tarjeta.
     */
    public function transacciones()
    {
        return $this->hasMany(Transaccion::class, 'tarjeta_id');
    }
}