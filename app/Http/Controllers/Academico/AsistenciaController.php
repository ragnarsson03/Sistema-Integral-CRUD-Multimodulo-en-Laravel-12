<?php

namespace App\Http\Controllers\Academico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Academico\Estudiante;
use App\Models\Academico\Asistencia;
use Illuminate\Support\Facades\DB;

class AsistenciaController extends Controller
{
    /**
     * Muestra la lista de asistencias para una fecha específica.
     */
    public function index(Request $request)
    {
        $fecha = $request->fecha ?? now()->format('Y-m-d');
        $estudiantes = Estudiante::orderBy('apellido')->orderBy('nombre')->get();
        
        // Obtener asistencias existentes para la fecha seleccionada
        $asistenciasRegistradas = Asistencia::where('fecha', $fecha)->get();
        
        // Crear arrays para almacenar estados y observaciones
        $asistencias = [];
        $observaciones = [];
        
        foreach ($asistenciasRegistradas as $asistencia) {
            $asistencias[$asistencia->estudiante_id] = $asistencia->estado;
            $observaciones[$asistencia->estudiante_id] = $asistencia->observacion;
        }
        
        return view('academico.asistencias.index', compact('estudiantes', 'asistencias', 'observaciones', 'fecha'));
    }

    /**
     * Almacena las asistencias en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'estudiante_id' => 'required|array',
            'estado' => 'required|array',
        ]);
        
        $fecha = $request->fecha;
        $estudianteIds = $request->estudiante_id;
        $estados = $request->estado;
        $observaciones = $request->observaciones ?? [];
        
        // Comenzar una transacción para asegurar que todas las asistencias se guarden correctamente
        DB::beginTransaction();
        
        try {
            // Eliminar asistencias existentes para la fecha seleccionada
            Asistencia::where('fecha', $fecha)->delete();
            
            // Consultar un curso_id válido de la base de datos
            $cursoValido = DB::table('cursos')->first();
            
            if (!$cursoValido) {
                throw new \Exception('No hay cursos disponibles en el sistema. Por favor, cree al menos un curso.');
            }
            
            // Guardar las nuevas asistencias
            foreach ($estudianteIds as $index => $estudianteId) {
                if (isset($estados[$estudianteId])) {
                    // Obtener el curso del estudiante (si existe esa relación)
                    $estudiante = Estudiante::find($estudianteId);
                    $cursoId = $estudiante->curso_id ?? $cursoValido->id; // Usa el curso del estudiante o el primer curso válido
                    
                    Asistencia::create([
                        'fecha' => $fecha,
                        'estudiante_id' => $estudianteId,
                        'estado' => $estados[$estudianteId],
                        'observacion' => $observaciones[$estudianteId] ?? null,
                        'curso_id' => $cursoId, // Agregar el curso_id válido
                    ]);
                }
            }
            
            DB::commit();
            
            return redirect()->route('academico.asistencias.index', ['fecha' => $fecha])
                            ->with('success', 'Asistencia registrada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()->withErrors(['error' => 'Error al guardar las asistencias: ' . $e->getMessage()]);
        }
    }

    /**
     * Muestra las asistencias de un estudiante específico.
     */
    public function estudiante(Estudiante $estudiante)
    {
        $asistencias = Asistencia::where('estudiante_id', $estudiante->id)
                                ->orderBy('fecha', 'desc')
                                ->paginate(15);
        
        return view('academico.asistencias.estudiante', compact('estudiante', 'asistencias'));
    }

    /**
     * Muestra las asistencias de un estudiante específico (método alternativo para la ruta específica).
     */
    public function showEstudianteAsistencias(Estudiante $estudiante)
    {
        return $this->estudiante($estudiante);
    }
}