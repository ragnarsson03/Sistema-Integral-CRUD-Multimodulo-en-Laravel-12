<?php

namespace App\Models\Comedor;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    use HasFactory;
    
    protected $table = 'transacciones_comedor';
    
    protected $fillable = [
        'tarjeta_id',
        'tipo',
        'monto',
        'descripcion',
        'operador_id',
    ];
    
    protected $casts = [
        'monto' => 'decimal:2',
    ];
    
    /**
     * Obtiene la tarjeta asociada a esta transacción.
     */
    public function tarjeta()
    {
        return $this->belongsTo(Tarjeta::class);
    }
    
    /**
     * Obtiene el operador que realizó la transacción.
     */
    public function operador()
    {
        return $this->belongsTo(User::class, 'operador_id');
    }
}