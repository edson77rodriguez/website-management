<?php

namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use App\Models\Asignacion;
use App\Models\Estudiante;
use App\Models\Calificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalificacionController extends Controller
{
    /**
     * Ya NO usamos la constante.
     */
    // private const NUMERO_DE_UNIDADES = 5; // <-- ELIMINADO

    /**
     * Muestra la cuadrícula de calificaciones (Alumnos vs. Unidades).
     */
    public function show(Asignacion $asignacion)
    {
        if ($asignacion->docente_id !== Auth::user()->docente->id) {
            abort(403, 'Acceso no autorizado.');
        }

        // --- INICIO DE CAMBIOS ---
        // 1. Cargamos la relación 'materia' para acceder a sus propiedades
        $asignacion->load('materia');

        // 2. Leemos el N° de unidades DINÁMICAMENTE desde la materia
        $unidades = $asignacion->materia->numero_unidades;
        // --- FIN DE CAMBIOS ---

        $estudiantes = Estudiante::where('grupo_id', $asignacion->grupo_id)
                                 ->with('user')
                                 ->get()
                                 ->sortBy('user.apellido_paterno');

        $calificacionesData = Calificacion::where('asignacion_id', $asignacion->id)
                                    ->get();

        $calificaciones = [];
        foreach ($calificacionesData as $calif) {
            $calificaciones[$calif->estudiante_id][$calif->numero_unidad] = $calif->calificacion;
        }
        
        return view('docente.calificaciones.show', compact(
            'asignacion', 
            'estudiantes', 
            'calificaciones',
            'unidades' // Pasamos el N° de unidades dinámico
        ));
    }

    /**
     * Guarda (o actualiza) la cuadrícula de calificaciones.
     */
    public function store(Request $request, Asignacion $asignacion)
    {
        if ($asignacion->docente_id !== Auth::user()->docente->id) {
            abort(403, 'Acceso no autorizado.');
        }
        
        // --- INICIO DE CAMBIOS ---
        // 1. Obtenemos el N° de unidades de la materia para el bucle
        $asignacion->load('materia');
        $unidades = $asignacion->materia->numero_unidades;
        // --- FIN DE CAMBIOS ---

        $request->validate([
            'calificaciones' => 'required|array',
            'calificaciones.*' => 'required|array',
            'calificaciones.*.*' => 'nullable|numeric|min:0|max:100',
        ]);

        foreach ($request->calificaciones as $estudiante_id => $notasUnidades) {
            
            // Usamos el N° de unidades dinámico en el bucle
            for ($i = 1; $i <= $unidades; $i++) {
                
                $nota = $notasUnidades[$i] ?? null; 

                Calificacion::updateOrCreate(
                    [
                        'asignacion_id' => $asignacion->id,
                        'estudiante_id' => $estudiante_id,
                        'numero_unidad' => $i,
                    ],
                    [
                        'calificacion' => $nota
                    ]
                );
            }
        }

        return redirect()->route('docente.asistencia.index')
                         ->with('success', 'Calificaciones guardadas exitosamente.');
    }
}