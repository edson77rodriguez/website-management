<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asignacion;
use App\Models\Docente; // <-- Necesitamos este
use App\Models\Grupo;   // <-- Necesitamos este
use App\Models\Materia; // <-- Necesitamos este
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // <-- Para validación avanzada

class AsignacionController extends Controller
{
    /**
     * Muestra la lista de asignaciones.
     */
    public function index()
    {
        // Usamos "with" (Eager Loading) para cargar las relaciones
        // y evitar el problema N+1. Esto es una buena práctica.
        $asignaciones = Asignacion::with(['docente.user', 'grupo', 'materia'])
                                  ->paginate(10);
                                  
        return view('admin.asignaciones.index', compact('asignaciones'));
    }

    /**
     * Muestra el formulario para crear una nueva asignación.
     */
    public function create()
    {
        // Necesitamos pasar todos los docentes, grupos y materias a la vista
        // para rellenar los menús <select>
        $docentes = Docente::with('user')->get(); // 'with' para obtener el nombre del usuario
        $grupos = Grupo::all();
        $materias = Materia::all();
        
        return view('admin.asignaciones.create', compact('docentes', 'grupos', 'materias'));
    }

    /**
     * Guarda la nueva asignación en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'docente_id' => ['required', 'exists:docentes,id'],
            'grupo_id' => ['required', 'exists:grupos,id'],
            'materia_id' => [
                'required', 
                'exists:materias,id',
                // Regla de validación: La combinación Grupo+Materia debe ser única
                // para evitar asignar "Matemáticas" al grupo "ISC-702" dos veces.
                Rule::unique('asignaciones')->where(function ($query) use ($request) {
                    return $query->where('grupo_id', $request->grupo_id);
                }),
            ],
        ], [
            // Mensaje de error personalizado para la regla única
            'materia_id.unique' => 'Esta materia ya ha sido asignada a este grupo.'
        ]);

        Asignacion::create($request->all());

        return redirect()->route('admin.asignaciones.index')
                         ->with('success', 'Asignación creada exitosamente.');
    }

    /**
     * Muestra el formulario para editar una asignación.
     */
    public function edit(Asignacion $asignacion)
    {
        // Cargamos los datos para los <select>, igual que en create()
        $docentes = Docente::with('user')->get();
        $grupos = Grupo::all();
        $materias = Materia::all();

        return view('admin.asignaciones.edit', compact('asignacion', 'docentes', 'grupos', 'materias'));
    }

    /**
     * Actualiza la asignación en la base de datos.
     */
    public function update(Request $request, Asignacion $asignacion)
    {
        $request->validate([
            'docente_id' => ['required', 'exists:docentes,id'],
            'grupo_id' => ['required', 'exists:grupos,id'],
            'materia_id' => [
                'required', 
                'exists:materias,id',
                // Misma regla única, pero ignorando el ID de la asignación actual
                Rule::unique('asignaciones')->where(function ($query) use ($request) {
                    return $query->where('grupo_id', $request->grupo_id);
                })->ignore($asignacion->id),
            ],
        ], [
            'materia_id.unique' => 'Esta materia ya ha sido asignada a este grupo.'
        ]);

        $asignacion->update($request->all());

        return redirect()->route('admin.asignaciones.index')
                         ->with('success', 'Asignación actualizada exitosamente.');
    }

    /**
     * Elimina la asignación de la base de datos.
     */
    /**
     * Elimina la asignación de la base de datos.
     */
  /**
     * Elimina la asignación de la base de datos.
     */
    public function destroy(Asignacion $asignacion)
    {
        // --- INICIO DE LA CORRECCIÓN ---

        // 1. VERIFICACIÓN DE ASISTENCIAS
        // El controlador pregunta: "¿Esta asignación tiene asistencias?"
        if ($asignacion->asistencias()->exists()) {
            return redirect()->route('admin.asignaciones.index')
                             ->with('error', 'No se puede eliminar. Esta asignación ya tiene registros de ASISTENCIA.');
        }

        // 2. VERIFICACIÓN DE CALIFICACIONES
        // El controlador pregunta: "¿Esta asignación tiene calificaciones?"
        if ($asignacion->calificaciones()->exists()) {
            return redirect()->route('admin.asignaciones.index')
                             ->with('error', 'No se puede eliminar. Esta asignación ya tiene CALIFICACIONES registradas.');
        }

        // 3. SI PASA AMBAS PRUEBAS, SE ELIMINA
        try {
            $asignacion->delete();

            return redirect()->route('admin.asignaciones.index')
                             ->with('success', 'Asignación eliminada exitosamente.');
                             
        } catch (\Exception $e) {
            // Un 'catch' final por si algo más falla
            return redirect()->route('admin.asignaciones.index')
                             ->with('error', 'Error inesperado al eliminar la asignación: ' . $e->getMessage());
        }
        // --- FIN DE LA CORRECCIÓN ---
    }
}