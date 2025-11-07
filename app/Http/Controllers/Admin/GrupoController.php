<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // <-- Importante
use App\Models\Grupo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GrupoController extends Controller
{
    /**
     * Muestra la lista de grupos.
     */
    public function index()
    {
        $grupos = Grupo::paginate(10);
        return view('admin.grupos.index', compact('grupos'));
    }

    /**
     * Muestra el formulario para crear un nuevo grupo.
     */
    public function create()
    {
        return view('admin.grupos.create');
    }

    /**
     * Guarda el nuevo grupo en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_grupo' => ['required', 'string', 'max:50', Rule::unique('grupos')],
            'turno' => ['required', 'in:Matutino,Vespertino'],
        ]);

        Grupo::create($request->all());

        return redirect()->route('admin.grupos.index')
                         ->with('success', 'Grupo creado exitosamente.');
    }

    /**
     * Muestra el formulario para editar un grupo.
     */
    public function edit(Grupo $grupo)
    {
        return view('admin.grupos.edit', compact('grupo'));
    }

    /**
     * Actualiza el grupo en la base de datos.
     */
    public function update(Request $request, Grupo $grupo)
    {
        $request->validate([
            'nombre_grupo' => [
                'required', 
                'string', 
                'max:50', 
                Rule::unique('grupos')->ignore($grupo->id)
            ],
            'turno' => ['required', 'in:Matutino,Vespertino'],
        ]);

        $grupo->update($request->all());

        return redirect()->route('admin.grupos.index')
                         ->with('success', 'Grupo actualizado exitosamente.');
    }

    /**
     * Elimina el grupo de la base de datos.
     */
    public function destroy(Grupo $grupo)
    {
        // VERIFICACIÓN DE SEGURIDAD MÁS ESTRICTA
        if ($grupo->estudiantes()->exists()) {
            return redirect()->route('admin.grupos.index')
                             ->with('error', 'No se puede eliminar. Este grupo ya tiene estudiantes asignados.');
        }

        if ($grupo->asignaciones()->exists()) {
            return redirect()->route('admin.grupos.index')
                             ->with('error', 'No se puede eliminar. Este grupo ya tiene materias (asignaciones) asignadas.');
        }

        $grupo->delete();

        return redirect()->route('admin.grupos.index')
                         ->with('success', 'Grupo eliminado exitosamente.');
    }
}