<?php

namespace App\Http\Controllers\Academico;
use App\Models\Academico\Curso;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Academico\Estudiante;
use App\Models\Academico\Nota;

class NotaController extends Controller
{
    /**
     * Muestra la lista de notas.
     */
    public function index(Request $request)
    {
        $query = Nota::with(['estudiante', 'curso']);
        
        // Filtrar por grado si se proporciona
        if ($request->has('grado') && $request->grado) {
            $query->whereHas('estudiante', function($q) use ($request) {
                $q->where('grado', $request->grado);
            });
        }
        
        // Filtrar por curso si se proporciona
        if ($request->has('curso_id') && $request->curso_id) {
            $query->where('curso_id', $request->curso_id);
        }
        
        // Filtrar por período si se proporciona
        if ($request->has('periodo') && $request->periodo) {
            $query->where('periodo', $request->periodo);
        }
        
        $notas = $query->orderBy('created_at', 'desc')->paginate(15);
        
        // Obtener lista de cursos para el filtro
        $cursos = Curso::orderBy('nombre')->get();
        
        return view('academico.notas.index', compact('notas', 'cursos'));
    }

    /**
     * Muestra el formulario para crear una nueva nota.
     */
    public function create()
    {
        // Verificar si existen cursos
        $cursosCount = Curso::count();
        if ($cursosCount === 0) {
            return redirect()->route('academico.cursos.create')
                             ->with('warning', 'Debe crear al menos un curso antes de registrar notas. Por favor, cree un curso primero.');
        }

        $estudiantes = Estudiante::orderBy('apellido')->orderBy('nombre')->get();
        $cursos = Curso::orderBy('nombre')->get();
        
        // Verificar si hay estudiantes
        if ($estudiantes->isEmpty()) {
            return redirect()->route('academico.estudiantes.create')
                             ->with('warning', 'Debe registrar al menos un estudiante antes de crear notas. Por favor, registre un estudiante primero.');
        }

        return view('academico.notas.create', compact('estudiantes', 'cursos'));
    }

    /**
     * Almacena una nueva nota en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'estudiante_id' => 'required|exists:estudiantes,id',
            'curso_id' => 'required|exists:cursos,id',
            'calificacion' => 'required|numeric|min:0|max:20',
            'periodo' => 'required|string|max:50',
            'fecha' => 'required|date',
            'observaciones' => 'nullable|string|max:500',
        ]);
        
        Nota::create($request->all());
        
        return redirect()->route('academico.notas.index')
                        ->with('success', 'Nota registrada correctamente.');
    }

    /**
     * Muestra el formulario para editar una nota.
     */
    public function edit(Nota $nota)
    {
        $estudiantes = Estudiante::orderBy('apellido')->orderBy('nombre')->get();
        $cursos = Curso::orderBy('nombre')->get();
        return view('academico.notas.edit', compact('nota', 'estudiantes', 'cursos'));
    }

    /**
     * Actualiza una nota en la base de datos.
     */
    public function update(Request $request, Nota $nota)
    {
        $request->validate([
            'estudiante_id' => 'required|exists:estudiantes,id',
            'curso_id' => 'required|exists:cursos,id',
            'calificacion' => 'required|numeric|min:0|max:20',
            'periodo' => 'required|string|max:50',
            'fecha' => 'required|date',
            'observaciones' => 'nullable|string|max:500',
        ]);
        
        $nota->update($request->all());
        
        return redirect()->route('academico.notas.index')
                        ->with('success', 'Nota actualizada correctamente.');
    }

    /**
     * Elimina una nota de la base de datos.
     */
    public function destroy(Nota $nota)
    {
        $nota->delete();
        
        return redirect()->route('academico.notas.index')
                        ->with('success', 'Nota eliminada correctamente.');
    }

    /**
     * Muestra las notas de un estudiante específico.
     */
    public function estudiante(Estudiante $estudiante)
    {
        $notas = Nota::where('estudiante_id', $estudiante->id)
                    ->orderBy('fecha', 'desc')
                    ->paginate(15);
        
        return view('academico.notas.estudiante', compact('estudiante', 'notas'));
    }
}