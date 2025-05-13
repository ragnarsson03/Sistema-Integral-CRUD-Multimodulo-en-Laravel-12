<?php

namespace App\Http\Controllers\Farmacia;

use App\Http\Controllers\Controller;
use App\Models\Farmacia\Medicamento;
use App\Models\Farmacia\Movimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalidaController extends Controller
{
    /**
     * Muestra el formulario para registrar una salida.
     */
    public function create()
    {
        $medicamentos = Medicamento::where('stock', '>', 0)->get();
        return view('farmacia.movimientos.salida', compact('medicamentos'));
    }

    /**
     * Almacena una nueva salida en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'medicamento_id' => 'required|exists:medicamentos,id',
            'cantidad' => 'required|integer|min:1',
            'motivo' => 'required|string',
            'fecha' => 'required|date',
            'observaciones' => 'nullable|string',
        ]);

        $medicamento = Medicamento::findOrFail($request->medicamento_id);

        // Verificar si hay suficiente stock
        if ($medicamento->stock < $request->cantidad) {
            return back()->withErrors(['cantidad' => 'No hay suficiente stock disponible.'])->withInput();
        }

        DB::beginTransaction();
        try {
            // Registrar el movimiento
            Movimiento::create([
                'medicamento_id' => $request->medicamento_id,
                'tipo' => 'salida',
                'cantidad' => $request->cantidad,
                'motivo' => $request->motivo,
                'observaciones' => $request->observaciones,
                'fecha' => $request->fecha,
                'usuario_id' => auth()->id(),
            ]);

            // Actualizar el stock del medicamento
            $medicamento->stock -= $request->cantidad;
            $medicamento->save();

            DB::commit();
            return redirect()->route('farmacia.movimientos.index')
                ->with('success', 'Salida registrada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al registrar la salida: ' . $e->getMessage()])->withInput();
        }
    }
}