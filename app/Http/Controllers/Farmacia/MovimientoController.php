<?php

namespace App\Http\Controllers\Farmacia;

use App\Http\Controllers\Controller;
use App\Models\Farmacia\Movimiento;
use Illuminate\Http\Request;

class MovimientoController extends Controller
{
    /**
     * Muestra una lista de todos los movimientos.
     */
    public function index(Request $request)
    {
        $query = Movimiento::with(['medicamento', 'usuario']);

        // Filtrar por tipo si se proporciona
        if ($request->has('tipo') && in_array($request->tipo, ['entrada', 'salida'])) {
            $query->where('tipo', $request->tipo);
        }

        // Filtrar por medicamento si se proporciona
        if ($request->has('medicamento_id')) {
            $query->where('medicamento_id', $request->medicamento_id);
        }

        // Filtrar por fecha si se proporciona
        if ($request->has('fecha_desde')) {
            $query->whereDate('fecha', '>=', $request->fecha_desde);
        }

        if ($request->has('fecha_hasta')) {
            $query->whereDate('fecha', '<=', $request->fecha_hasta);
        }

        $movimientos = $query->orderBy('fecha', 'desc')->paginate(10);
        
        return view('farmacia.movimientos.index', compact('movimientos'));
    }
}