<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semestre;
use Illuminate\Validation\Rule;
class SemestreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
 * Display a listing of the resource.
 */
public function index()
{
    $semestres = Semestre::paginate(10);

    return view('admin.semestres.index', compact('semestres'));
}

 
public function create()
{
    return view('admin.semestres.create');
}

    /**
     * Store a newly created resource in storage.
     */
    /**
 * Guarda el nuevo semestre en la base de datos.
 */
public function store(Request $request)
{
    // 1. Validación (debe ser único)
    $request->validate([
        'descripcion' => ['required', 'string', 'max:50', Rule::unique('semestres')],
    ]);

    // 2. Creación
    Semestre::create([
        'descripcion' => $request->descripcion,
    ]);

    // 3. Redirección
    return redirect()->route('admin.semestres.index')
                     ->with('success', 'Semestre creado exitosamente.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Semestre $semestre) // <-- Usa Route-Model Binding
    {
        return view('admin.semestres.edit', compact('semestre'));
    }

   public function update(Request $request, Semestre $semestre)
    {
        // 1. Validación (único, pero ignorando el ID actual)
        $request->validate([
            'descripcion' => [
                'required', 
                'string', 
                'max:50', 
                Rule::unique('semestres')->ignore($semestre->id)
            ],
        ]);

        // 2. Actualización
        $semestre->update([
            'descripcion' => $request->descripcion,
        ]);

        // 3. Redirección
        return redirect()->route('admin.semestres.index')
                         ->with('success', 'Semestre actualizado exitosamente.');
    }

    /**
     * Elimina el semestre de la base de datos.
     */
    public function destroy(Semestre $semestre)
    {
        // *** VERIFICACIÓN DE SEGURIDAD ***
        // Verificamos si algún estudiante está usando este semestre
        if ($semestre->estudiantes()->exists()) {
            return redirect()->route('admin.semestres.index')
                             ->with('error', 'No se puede eliminar. Este semestre ya está asignado a uno or más estudiantes.');
        }

        $semestre->delete();

        return redirect()->route('admin.semestres.index')
                         ->with('success', 'Semestre eliminado exitosamente.');
    }
}
