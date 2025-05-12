<?php

namespace App\Http\Controllers\Comedor;

use App\Http\Controllers\Controller;
use App\Models\Comedor\Tarjeta;
use Illuminate\Http\Request;

class TarjetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tarjetas = Tarjeta::with('estudiante')->latest()->paginate(10);
        return view('comedor.tarjetas.index', compact('tarjetas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('comedor.tarjetas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|max:50|unique:tarjetas_comedor,codigo',
            'estudiante_id' => 'required|exists:estudiantes,id',
            'saldo' => 'required|numeric|min:0',
            'activa' => 'boolean',
        ]);

        Tarjeta::create($request->all());

        return redirect()->route('comedor.tarjetas.index')
            ->with('success', 'Tarjeta creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarjeta $tarjeta)
    {
        return view('comedor.tarjetas.show', compact('tarjeta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarjeta $tarjeta)
    {
        return view('comedor.tarjetas.edit', compact('tarjeta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarjeta $tarjeta)
    {
        $request->validate([
            'codigo' => 'required|string|max:50|unique:tarjetas_comedor,codigo,' . $tarjeta->id,
            'estudiante_id' => 'required|exists:estudiantes,id',
            'saldo' => 'required|numeric|min:0',
            'activa' => 'boolean',
        ]);

        $tarjeta->update($request->all());

        return redirect()->route('comedor.tarjetas.index')
            ->with('success', 'Tarjeta actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarjeta $tarjeta)
    {
        $tarjeta->delete();

        return redirect()->route('comedor.tarjetas.index')
            ->with('success', 'Tarjeta eliminada exitosamente.');
    }
}