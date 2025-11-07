<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Calificacion;
use App\Models\Asistencia;
use Illuminate\Support\Facades\DB;

class HistorialController extends Controller
{
    /**
     * Muestra el historial de calificaciones y asistencias del estudiante.
     */
    public function index()
    {
        // 1. Obtener el perfil del estudiante logueado
        $estudiante = Auth::user()->estudiante;

        // 2. Obtener calificaciones (solo las no nulas) y AGRUPARLAS por clase
        $calificacionesAgrupadas = Calificacion::where('estudiante_id', $estudiante->id)
                                    ->whereNotNull('calificacion') 
                                    ->with(['asignacion.materia'])
                                    ->get()
                                    ->groupBy('asignacion_id'); 

        // 3. Obtener un resumen de asistencias (para la tarjeta de resumen)
        $resumenAsistencias = Asistencia::where('estudiante_id', $estudiante->id)
                            ->select('asignacion_id', 'estado', DB::raw('count(*) as total'))
                            ->groupBy('asignacion_id', 'estado')
                            ->with(['asignacion.materia'])
                            ->get()
                            ->groupBy('asignacion_id');

        // --- INICIO DE LA OPTIMIZACIÓN DEL CALENDARIO ---
        
        // 4. Obtener TODAS las asistencias diarias en UNA SOLA CONSULTA
        $asistenciasDiarias = Asistencia::where('estudiante_id', $estudiante->id)
                                      ->with(['asignacion.materia']) // Carga la materia
                                      ->get();
        
        // 5. Preparar los eventos para FullCalendar
        $eventosCalendario = [];
        foreach ($asistenciasDiarias as $asistencia) {
            
            // Si la materia no existe (raro, pero seguro), saltar
            if (!$asistencia->asignacion || !$asistencia->asignacion->materia) {
                continue;
            }

            $color = match($asistencia->estado) {
                'Presente' => '#28a745',    // Verde
                'Ausente' => '#dc3545',     // Rojo
                'Retardo' => '#ffc107',     // Amarillo
                'Justificado' => '#17a2b8', // Azul claro
                default => '#6c757d'        // Gris
            };

            $eventosCalendario[] = [
                'title' => $asistencia->asignacion->materia->nombre_materia . ' - ' . $asistencia->estado,
                'start' => $asistencia->fecha, // FullCalendar entiende 'YYYY-MM-DD'
                'backgroundColor' => $color,
                'borderColor' => $color,
                'classNames' => ['asistencia-' . strtolower($asistencia->estado)]
            ];
        }
        // --- FIN DE LA OPTIMIZACIÓN DEL CALENDARIO ---

        // Pasamos todas las variables a la vista
        return view('estudiante.historial.index', [
            'calificacionesAgrupadas' => $calificacionesAgrupadas, 
            'resumenAsistencias' => $resumenAsistencias,
            'eventosCalendario' => $eventosCalendario // El array de eventos listo
        ]);
    }
}