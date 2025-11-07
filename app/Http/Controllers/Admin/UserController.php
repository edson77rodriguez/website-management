<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Docente;    // <-- 1. IMPORTAR MODELOS
use App\Models\Estudiante; // <-- 1. IMPORTAR MODELOS
use App\Models\Semestre;   // <-- 1. IMPORTAR MODELOS
use App\Models\Grupo;      // <-- 1. IMPORTAR MODELOS
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule; // <-- 1. IMPORTAR REGLAS
use Illuminate\Support\Facades\Auth;
Class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        // --- 2. CAMBIO EN CREATE ---
        // Necesitamos pasar los catálogos a la vista para
        // los menús <select> del formulario de Estudiante.
        $semestres = Semestre::all();
        $grupos = Grupo::all();

        return view('admin.users.create', compact('semestres', 'grupos'));
    }

    /**
     * Guarda el nuevo usuario en la base de datos.
     */
    public function store(Request $request)
    {
        // --- 3. CAMBIO EN VALIDACIÓN ---
        $request->validate([
            'nombre' => ['required', 'string', 'max:50'],
            'apellido_paterno' => ['required', 'string', 'max:50'],
            'apellido_materno' => ['nullable', 'string', 'max:50'],
            'rol' => ['required', 'in:Administrador,Docente,Estudiante'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            
            // Campos de Estudiante: requeridos SÓLO SI el rol es 'Estudiante'
            'matricula' => ['required_if:rol,Estudiante', 'nullable', 'string', 'max:20', Rule::unique('estudiantes', 'matricula')],
            'semestre_id' => ['required_if:rol,Estudiante', 'nullable', 'exists:semestres,id'],
            'grupo_id' => ['required_if:rol,Estudiante', 'nullable', 'exists:grupos,id'],
        ]);

        // --- 4. CAMBIO EN LÓGICA DE CREACIÓN ---
        
        // 4.1. Creamos el usuario base
        $user = User::create([
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'email' => $request->email,
            'rol' => $request->rol,
            'password' => Hash::make($request->password),
        ]);

        // 4.2. Creamos el registro en la tabla de rol correspondiente
        if ($request->rol === 'Docente') {
            
            // Usamos la relación para crear el docente
            $user->docente()->create(); 
            // (Asume que 'especialidad' es nullable, lo cual es correcto)

        } 
        elseif ($request->rol === 'Estudiante') {
            
            // Usamos la relación para crear el estudiante con sus datos
            $user->estudiante()->create([
                'matricula' => $request->matricula,
                'semestre_id' => $request->semestre_id,
                'grupo_id' => $request->grupo_id,
            ]);
        }
        
        // 4.3. Redirección
        return redirect()->route('admin.usuarios.index')
                         ->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Muestra el formulario para editar un usuario.
     * (NOTA: La lógica de 'update' también necesitará esta
     * lógica de roles, pero la dejaremos para después)
     */
    public function edit(User $usuario)
    {
        // (Por ahora, esto solo edita el 'User', no el 'Docente' o 'Estudiante')
        return view('admin.users.edit', [
            'user' => $usuario
        ]);
    }

    /**
     * Actualiza el usuario en la base de datos.
     * (ADVERTENCIA: Este 'update' está incompleto, solo actualiza la tabla 'users'.
     * Necesitará la misma lógica de 'store' para manejar los perfiles.)
     */
    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:50'],
            'apellido_paterno' => ['required', 'string', 'max:50'],
            'apellido_materno' => ['nullable', 'string', 'max:50'],
            'rol' => ['required', 'in:Administrador,Docente,Estudiante'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($usuario->id)],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()], 
        ]);

        // (Lógica de 'update' incompleta)
        $usuario->update([
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'email' => $request->email,
            'rol' => $request->rol,
        ]);

        if ($request->filled('password')) {
            $usuario->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('admin.usuarios.index')
                         ->with('success', 'Usuario (base) actualizado exitosamente.');
    }

    /**
     * Elimina el usuario.
     */
    public function destroy(User $usuario)
    {
        if (Auth::id() === $usuario->id) {
            return redirect()->route('admin.usuarios.index')
                             ->with('error', 'No puedes eliminarte a ti mismo.');
        }
        
        // Gracias a 'onDelete('cascade')' en la migración,
        // al borrar el User, se borrará su perfil de docente/estudiante.
        $usuario->delete();

        return redirect()->route('admin.usuarios.index')
                         ->with('success', 'Usuario eliminado exitosamente.');
    }
}