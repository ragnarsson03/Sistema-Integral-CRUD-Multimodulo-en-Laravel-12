<?php

namespace App\Http\Controllers\Academico;

use App\Http\Controllers\Controller;
use App\Models\Academico\Curso;
use App\Models\User;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Muestra la lista de cursos.
     */
    public function index()
    {
        $cursos = Curso::orderBy('nombre')->paginate(10);
        return view('academico.cursos.index', compact('cursos'));
    }

    /**
     * Muestra el formulario para crear un nuevo curso.
     */
    public function create()
    {
        // En lugar de User::role('profesor')
        $profesores = User::all();
        return view('academico.cursos.create', compact('profesores'));
    }

    /**
     * Almacena un nuevo curso en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:50|unique:cursos',
            'descripcion' => 'nullable|string',
            'profesor_id' => 'required|exists:users,id',
            'nivel' => 'nullable|integer',
            'activo' => 'boolean',
        ]);

        Curso::create([
            'nombre' => $request->nombre,
            'codigo' => $request->codigo,
            'descripcion' => $request->descripcion,
            'profesor_id' => $request->profesor_id,
            'nivel' => $request->nivel,
            'activo' => $request->activo ?? true,
        ]);

        return redirect()->route('academico.cursos.index')
                        ->with('success', 'Curso creado correctamente.');
    }

    /**
     * Muestra la información de un curso específico.
     */
    public function show(Curso $curso)
    {
        return view('academico.cursos.show', compact('curso'));
    }

    /**
     * Muestra el formulario para editar un curso.
     */
    public function edit(Curso $curso)
    {
        // En lugar de User::role('profesor')
        $profesores = User::all();
        return view('academico.cursos.edit', compact('curso', 'profesores'));
    }

    /**
     * Actualiza un curso en la base de datos.
     */
    public function update(Request $request, Curso $curso)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:50|unique:cursos,codigo,'.$curso->id,
            'descripcion' => 'nullable|string',
            'profesor_id' => 'required|exists:users,id',
            'nivel' => 'nullable|integer',
            'activo' => 'boolean',
        ]);

        $curso->update([
            'nombre' => $request->nombre,
            'codigo' => $request->codigo,
            'descripcion' => $request->descripcion,
            'profesor_id' => $request->profesor_id,
            'nivel' => $request->nivel,
            'activo' => $request->activo ?? true,
        ]);

        return redirect()->route('academico.cursos.index')
                        ->with('success', 'Curso actualizado correctamente.');
    }

    /**
     * Elimina un curso de la base de datos.
     */
    public function destroy(Curso $curso)
    {
        // Verificar si hay estudiantes o asistencias asociadas
        if ($curso->estudiantes()->count() > 0 || $curso->asistencias()->count() > 0) {
            return back()->withErrors(['error' => 'No se puede eliminar el curso porque tiene estudiantes o asistencias asociadas.']);
        }

        $curso->delete();

        return redirect()->route('academico.cursos.index')
                        ->with('success', 'Curso eliminado correctamente.');
    }
}