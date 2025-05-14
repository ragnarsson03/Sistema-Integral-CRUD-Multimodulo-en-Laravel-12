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
            $observaciones[$asistencia->estudiante_id] = $asistencia->observaciones;
        }
        
        return view('academico.asistencias.index', compact('estudiantes', 'asistencias', 'observaciones'));
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
            
            // Guardar las nuevas asistencias
            foreach ($estudianteIds as $index => $estudianteId) {
                if (isset($estados[$estudianteId])) {
                    Asistencia::create([
                        'fecha' => $fecha,
                        'estudiante_id' => $estudianteId,
                        'estado' => $estados[$estudianteId],
                        'observaciones' => $observaciones[$estudianteId] ?? null,
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
}