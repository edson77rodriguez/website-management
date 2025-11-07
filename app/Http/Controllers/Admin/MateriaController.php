<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MateriaController extends Controller
{
    /**
     * Muestra la lista de materias.
     */
    public function index()
    {
        $materias = Materia::paginate(10);
        return view('admin.materias.index', compact('materias'));
    }

    /**
     * Muestra el formulario para crear una nueva materia.
     */
    public function create()
    {
        return view('admin.materias.create');
    }

    /**
     * Guarda la nueva materia en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_materia' => ['required', 'string', 'max:100', Rule::unique('materias')],
            'numero_unidades' => ['required', 'integer', 'min:1', 'max:15'], // <-- AÑADE ESTO
            'clave_materia' => ['nullable', 'string', 'max:20', Rule::unique('materias')->whereNotNull('clave_materia')],
        ]);

        Materia::create($request->all());

        return redirect()->route('admin.materias.index')
                         ->with('success', 'Materia creada exitosamente.');
    }

    /**
     * Muestra el formulario para editar una materia.
     */
    public function edit(Materia $materia)
    {
        return view('admin.materias.edit', compact('materia'));
    }

    /**
     * Actualiza la materia en la base de datos.
     */
    public function update(Request $request, Materia $materia)
    {
        $request->validate([
            'nombre_materia' => [
                'required', 
                'string', 
                'max:100', 
                Rule::unique('materias')->ignore($materia->id)
            ],
            'numero_unidades' => ['required', 'integer', 'min:1', 'max:15'], // <-- AÑADE ESTO
            'clave_materia' => [
                'nullable', 
                'string', 
                'max:20', 
                Rule::unique('materias')->ignore($materia->id)->whereNotNull('clave_materia')
            ],
        ]);

        $materia->update($request->all());

        return redirect()->route('admin.materias.index')
                         ->with('success', 'Materia actualizada exitosamente.');
    }

    /**
     * Elimina la materia de la base de datos.
     */
    public function destroy(Materia $materia)
    {
        // VERIFICACIÓN DE SEGURIDAD
        if ($materia->asignaciones()->exists()) {
            return redirect()->route('admin.materias.index')
                             ->with('error', 'No se puede eliminar. Esta materia ya está en uso en una asignación.');
        }

        $materia->delete();

        return redirect()->route('admin.materias.index')
                         ->with('success', 'Materia eliminada exitosamente.');
    }
}