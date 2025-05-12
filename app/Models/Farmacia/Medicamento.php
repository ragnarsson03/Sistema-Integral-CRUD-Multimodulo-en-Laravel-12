<?php

namespace App\Models\Farmacia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'fecha_vencimiento',
    ];
    
    protected $casts = [
        'fecha_vencimiento' => 'date',
        'precio' => 'decimal:2',
    ];
}