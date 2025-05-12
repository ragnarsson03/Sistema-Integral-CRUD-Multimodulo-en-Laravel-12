<?php

namespace App\Http\Controllers\Farmacia;

use App\Http\Controllers\Controller;
use App\Models\Farmacia\Medicamento;
use App\Models\Farmacia\MovimientoInventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovimientoInventarioController extends Controller
{
    /**
     * Mostrar la lista de movimientos
     */
    public function index(Request $request)
    {
        $query = MovimientoInventario::with('medicamento');
        
        // Filtros
        if ($request->has('tipo_movimiento') && $request->tipo_movimiento) {
            $query->where('tipo_movimiento', $request->tipo_movimiento);
        }
        
        if ($request->has('fecha_desde') && $request->fecha_desde) {
            $query->whereDate('fecha_movimiento', '>=', $request->fecha_desde);
        }
        
        if ($request->has('fecha_hasta') && $request->fecha_hasta) {
            $query->whereDate('fecha_movimiento', '<=', $request->fecha_hasta);
        }
        
        if ($request->has('medicamento_id') && $request->medicamento_id) {
            $query->where('medicamento_id', $request->medicamento_id);
        }
        
        $movimientos = $query->latest('fecha_movimiento')->paginate(15);
        $medicamentos = Medicamento::orderBy('nombre')->get();
        
        return view('farmacia.movimientos.index', compact('movimientos', 'medicamentos'));
    }
    
    /**
     * Mostrar formulario para registrar entrada
     */
    public function createEntrada()
    {
        $medicamentos = Medicamento::orderBy('nombre')->get();
        return view('farmacia.movimientos.entrada', compact('medicamentos'));
    }
    
    /**
     * Mostrar formulario para registrar salida
     */
    public function createSalida()
    {
        $medicamentos = Medicamento::orderBy('nombre')->get();
        return view('farmacia.movimientos.salida', compact('medicamentos'));
    }
    
    /**
     * Registrar una entrada de inventario
     */
    public function storeEntrada(Request $request)
    {
        $request->validate([
            'medicamento_id' => 'required|exists:medicamentos,id',
            'cantidad' => 'required|integer|min:1',
            'motivo' => 'required|string|max:255',
            'fecha_movimiento' => 'required|date',
            'observaciones' => 'nullable|string',
        ]);
        
        // Crear el movimiento
        $movimiento = MovimientoInventario::create([
            'medicamento_id' => $request->medicamento_id,
            'tipo_movimiento' => 'entrada',
            'cantidad' => $request->cantidad,
            'motivo' => $request->motivo,
            'fecha_movimiento' => $request->fecha_movimiento,
            'usuario_id' => Auth::id(),
            'observaciones' => $request->observaciones,
        ]);
        
        // Actualizar el stock del medicamento
        $medicamento = Medicamento::find($request->medicamento_id);
        $medicamento->stock += $request->cantidad;
        $medicamento->save();
        
        return redirect()->route('farmacia.movimientos.index')
            ->with('success', 'Entrada de inventario registrada exitosamente.');
    }
    
    /**
     * Registrar una salida de inventario
     */
    public function storeSalida(Request $request)
    {
        $request->validate([
            'medicamento_id' => 'required|exists:medicamentos,id',
            'cantidad' => 'required|integer|min:1',
            'motivo' => 'required|string|max:255',
            'fecha_movimiento' => 'required|date',
            'observaciones' => 'nullable|string',
        ]);
        
        // Verificar que haya suficiente stock
        $medicamento = Medicamento::find($request->medicamento_id);
        if ($medicamento->stock < $request->cantidad) {
            return back()->withErrors(['cantidad' => 'No hay suficiente stock disponible.'])->withInput();
        }
        
        // Crear el movimiento
        $movimiento = MovimientoInventario::create([
            'medicamento_id' => $request->medicamento_id,
            'tipo_movimiento' => 'salida',
            'cantidad' => $request->cantidad,
            'motivo' => $request->motivo,
            'fecha_movimiento' => $request->fecha_movimiento,
            'usuario_id' => Auth::id(),
            'observaciones' => $request->observaciones,
        ]);
        
        // Actualizar el stock del medicamento
        $medicamento->stock -= $request->cantidad;
        $medicamento->save();
        
        return redirect()->route('farmacia.movimientos.index')
            ->with('success', 'Salida de inventario registrada exitosamente.');
    }
    
    /**
     * Mostrar el dashboard de inventario
     */
    public function dashboard()
    {
        // Medicamentos con stock bajo (menos de 10 unidades)
        $stockBajo = Medicamento::where('stock', '<', 10)->get();
        
        // Medicamentos próximos a vencer (en los próximos 30 días)
        $proximosVencer = Medicamento::whereDate('fecha_vencimiento', '<=', now()->addDays(30))
            ->whereDate('fecha_vencimiento', '>=', now())
            ->get();
        
        // Estadísticas de movimientos
        $entradasHoy = MovimientoInventario::where('tipo_movimiento', 'entrada')
            ->whereDate('fecha_movimiento', today())
            ->count();
            
        $salidasHoy = MovimientoInventario::where('tipo_movimiento', 'salida')
            ->whereDate('fecha_movimiento', today())
            ->count();
            
        // Últimos 10 movimientos
        $ultimosMovimientos = MovimientoInventario::with('medicamento')
            ->latest('fecha_movimiento')
            ->take(10)
            ->get();
            
        return view('farmacia.dashboard', compact(
            'stockBajo', 
            'proximosVencer', 
            'entradasHoy', 
            'salidasHoy', 
            'ultimosMovimientos'
        ));
    }
}