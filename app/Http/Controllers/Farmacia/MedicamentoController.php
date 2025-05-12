<?php

namespace App\Http\Controllers\Farmacia;

use App\Http\Controllers\Controller;
use App\Models\Farmacia\Medicamento;
use Illuminate\Http\Request;

class MedicamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicamentos = Medicamento::latest()->paginate(10);
        return view('farmacia.medicamentos.index', compact('medicamentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('farmacia.medicamentos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'fecha_vencimiento' => 'nullable|date',
        ]);

        Medicamento::create($request->all());

        return redirect()->route('farmacia.medicamentos.index')
            ->with('success', 'Medicamento creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Medicamento $medicamento)
    {
        return view('farmacia.medicamentos.show', compact('medicamento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medicamento $medicamento)
    {
        return view('farmacia.medicamentos.edit', compact('medicamento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medicamento $medicamento)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'fecha_vencimiento' => 'nullable|date',
        ]);

        $medicamento->update($request->all());

        return redirect()->route('farmacia.medicamentos.index')
            ->with('success', 'Medicamento actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medicamento $medicamento)
    {
        $medicamento->delete();

        return redirect()->route('farmacia.medicamentos.index')
            ->with('success', 'Medicamento eliminado exitosamente.');
    }
}