<?php

namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- 1. Para saber quién está logueado
use App\Models\Asignacion; // <-- 2. Para buscar las asignaciones
use App\Models\Estudiante; // <-- 1. Importar Estudiante
use App\Models\Asistencia; // <-- 2. Importar Asistencia
use Carbon\Carbon;          // <-- 3. Importar Carbon para manejar fechas
class AsistenciaController extends Controller
{
    /**
     * Muestra la lista de asignaciones (clases) del docente logueado.
     */
    public function index()
    {
        // 1. Obtener el ID del docente logueado
        // Buscamos el 'user' logueado, luego su perfil 'docente'
        $docenteId = Auth::user()->docente->id;

        // 2. Buscar todas las asignaciones de ese docente
        // Usamos 'with' (Eager Loading) para cargar las relaciones 
        // y evitar consultas N+1 en la vista.
        $asignaciones = Asignacion::where('docente_id', $docenteId)
                                  ->with(['grupo', 'materia'])
                                  ->get(); // Usamos get() porque es una lista, no un CRUD admin

        // 3. Devolver la vista con sus asignaciones
        return view('docente.asistencia.index', compact('asignaciones'));
    }
    public function show(Asignacion $asignacion)
    {
        // Verificamos que el docente logueado sea el dueño de esta asignación
        if ($asignacion->docente_id !== Auth::user()->docente->id) {
            abort(403, 'Acceso no autorizado.');
        }

        $hoy = Carbon::today();

        // 1. Obtenemos los estudiantes del grupo de esta asignación
        $estudiantes = Estudiante::where('grupo_id', $asignacion->grupo_id)
                                 ->with('user') // Carga la info del usuario (nombre, etc.)
                                 ->get()
                                 ->sortBy('user.apellido_paterno'); // Ordena por apellido

        // 2. Buscamos si ya existe asistencia guardada para hoy
        // Esto nos permite pre-seleccionar los radio buttons si el docente ya guardó
        $asistenciasHoy = Asistencia::where('asignacion_id', $asignacion->id)
                                    ->whereDate('fecha', $hoy)
                                    ->pluck('estado', 'estudiante_id'); // Crea un array [estudiante_id => 'Presente']

        return view('docente.asistencia.show', compact('asignacion', 'estudiantes', 'asistenciasHoy', 'hoy'));
    }

    /**
     * Guarda (o actualiza) la asistencia del día.
     */
    public function store(Request $request, Asignacion $asignacion)
    {
        // Verificamos de nuevo por seguridad
        if ($asignacion->docente_id !== Auth::user()->docente->id) {
            abort(403, 'Acceso no autorizado.');
        }

        $request->validate([
            'asistencias' => 'required|array',
            'asistencias.*' => 'required|in:Presente,Ausente,Retardo,Justificado',
        ]);

        $hoy = Carbon::today();

        // 3. Iteramos sobre los datos enviados
        foreach ($request->asistencias as $estudiante_id => $estado) {
            
            // 4. Usamos updateOrCreate()
            // Esto es muy eficiente:
            // 1. BUSCA un registro que coincida con el primer array
            // 2. SI LO ENCUENTRA, lo actualiza con el segundo array
            // 3. SI NO LO ENCUENTRA, crea un nuevo registro con ambos arrays
            Asistencia::updateOrCreate(
                [
                    'asignacion_id' => $asignacion->id,
                    'estudiante_id' => $estudiante_id,
                    'fecha' => $hoy,
                ],
                [
                    'estado' => $estado
                ]
            );
        }

        return redirect()->route('docente.asistencia.index')
                         ->with('success', 'Asistencia guardada exitosamente.');
    }
}