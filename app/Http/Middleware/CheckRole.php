<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Necesitamos importar Auth
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  ...$roles (Aquí recibimos los roles permitidos, ej: 'Administrador', 'Docente')
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Verifica si el usuario ha iniciado sesión
        if (!Auth::check()) {
            return redirect('login');
        }

        // 2. Obtiene el usuario autenticado
        $user = Auth::user();

        // 3. Comprueba si el rol del usuario está en la lista de roles permitidos
        foreach ($roles as $role) {
            if ($user->rol === $role) {
                // 4. Si el rol coincide, permite el acceso a la ruta
                return $next($request);
            }
        }

        // 5. Si no coincide, deniega el acceso
        // abort(403, 'ACCESO NO AUTORIZADO');
        
        // O (más amigable) redirige al dashboard con un error
        return redirect('dashboard')->with('error', 'No tienes permiso para acceder a esa sección.');
    }
}