<?php

namespace App\Http\Controllers\Medico;

use App\Http\Controllers\Controller;
use App\Models\Medico\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pacientes = Paciente::latest()->paginate(10);
        return view('medico.pacientes.index', compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('medico.pacientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'cedula' => 'required|string|max:20|unique:pacientes', // Cambiado de 'dni' a 'cedula'
            'genero' => 'required|in:masculino,femenino,otro',
        ]);

        Paciente::create($request->all());

        return redirect()->route('medico.pacientes.index')
            ->with('success', 'Paciente creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Paciente $paciente)
    {
        return view('medico.pacientes.show', compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paciente $paciente)
    {
        return view('medico.pacientes.edit', compact('paciente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paciente $paciente)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'cedula' => 'required|string|max:20|unique:pacientes,cedula,' . $paciente->id, // Cambiado de 'dni' a 'cedula'
            'genero' => 'required|in:masculino,femenino,otro',
        ]);

        $paciente->update($request->all());

        return redirect()->route('medico.pacientes.index')
            ->with('success', 'Paciente actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paciente $paciente)
    {
        $paciente->delete();

        return redirect()->route('medico.pacientes.index')
            ->with('success', 'Paciente eliminado exitosamente.');
    }
}