<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// Modelos usados por el dashboard
use App\Models\User;
use App\Models\Semestre;
use App\Models\Materia;
use App\Models\Grupo;
use App\Models\Estudiante;
use App\Models\Docente;
use App\Models\Asignacion;
use App\Models\Calificacion;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SemestreController;
use App\Http\Controllers\Admin\GrupoController;
use App\Http\Controllers\Admin\MateriaController;
use App\Http\Controllers\Admin\AsignacionController;
use App\Http\Controllers\Docente\AsistenciaController;
use App\Http\Controllers\Docente\CalificacionController;
use App\Http\Controllers\Estudiante\HistorialController;
// --- RUTAS PÚBLICAS ---
// (Welcome, etc. no necesitan 'auth')
Route::get('/', function () {
    return view('welcome');
});

// --- RUTAS AUTENTICADAS (PARA TODOS LOS ROLES) ---
// (El dashboard es para todos, pero /profile solo para usuarios logueados)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        // Conteos y métricas dinámicas para el dashboard
        $usersCount = User::count();
        $adminsCount = User::where('rol', 'Administrador')->count();
        $docentesCount = User::where('rol', 'Docente')->count();
        $estudiantesCount = User::where('rol', 'Estudiante')->count();

        $semestresCount = Semestre::count();
        $materiasCount = Materia::count();
        $gruposCount = Grupo::count();

        $estudiantesModelCount = Estudiante::count();
        $docentesModelCount = Docente::count();

        $asignacionesCount = Asignacion::count();
        $calificacionesCount = Calificacion::count();

        // Valores por defecto para métricas de docente
        $docente_clases = 0;
        $docente_estudiantes = 0;
        $docente_asistencia_pendiente = 0;
        $docente_calificaciones_pendientes = 0;

        // Si el usuario es docente, calculamos métricas orientadas al docente
        if (auth()->check() && auth()->user()->isDocente()) {
            $docenteModel = Docente::where('user_id', auth()->id())->first();
            if ($docenteModel) {
                $asignaciones = Asignacion::where('docente_id', $docenteModel->id)->get();
                $asignacionIds = $asignaciones->pluck('id');

                // Clases asignadas al docente
                $docente_clases = $asignaciones->count();

                // Estudiantes totales en los grupos que el docente atiende
                $grupoIds = $asignaciones->pluck('grupo_id')->filter()->unique();
                $docente_estudiantes = Estudiante::whereIn('grupo_id', $grupoIds)->count();

                // Asistencias pendientes: clases sin registro de asistencia para hoy
                $today = now()->toDateString();
                $clasesConAsistenciaHoy = Asignacion::where('docente_id', $docenteModel->id)
                    ->whereHas('asistencias', function ($q) use ($today) {
                        $q->whereDate('fecha', $today);
                    })->count();
                $docente_asistencia_pendiente = max(0, $docente_clases - $clasesConAsistenciaHoy);

                // Calificaciones pendientes: estimación simple = estudiantes asignados - calificaciones registradas para estas asignaciones
                $calificacionesRegistradas = Calificacion::whereIn('asignacion_id', $asignacionIds)->count();
                $docente_calificaciones_pendientes = max(0, $docente_estudiantes - $calificacionesRegistradas);
            }
        }

        return view('dashboard', compact(
            'usersCount', 'adminsCount', 'docentesCount', 'estudiantesCount',
            'semestresCount', 'materiasCount', 'gruposCount',
            'estudiantesModelCount', 'docentesModelCount',
            'asignacionesCount', 'calificacionesCount',
            'docente_clases', 'docente_estudiantes', 'docente_asistencia_pendiente', 'docente_calificaciones_pendientes'
        ));
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// --- ESTA ES LA MAGIA DEL CONTROL DE ACCESO ---

// --- SECCIÓN SOLO PARA ADMINISTRADORES ---
// --- SECCIÓN SOLO PARA ADMINISTRADORES ---
Route::middleware(['auth', 'role:Administrador'])
    ->prefix('admin')  // <-- AÑADE ESTO
    ->name('admin.')   // <-- AÑADE ESTO
    ->group(function () {
    
    // Esta línea ahora sí generará 'admin.users.index'
    Route::resource('usuarios', UserController::class);
    Route::resource('semestres', SemestreController::class); // <-- AÑADE ESTA LÍNEA
    Route::resource('grupos', GrupoController::class); // <-- AÑADE ESTA LÍNEA
    Route::resource('materias', MateriaController::class); // <-- AÑADE ESTA LÍNEA
Route::resource('asignaciones', AsignacionController::class)
     ->parameters(['asignaciones' => 'asignacion']);
});

// --- SECCIÓN SOLO PARA DOCENTES ---
// --- SECCIÓN SOLO PARA DOCENTES ---
Route::middleware(['auth', 'role:Docente'])
    ->prefix('docente') 
    ->name('docente.')
    ->group(function () {

    // Rutas de Asistencia (existentes)
    Route::get('/asistencia', [AsistenciaController::class, 'index'])->name('asistencia.index');
    Route::get('/asistencia/{asignacion}', [AsistenciaController::class, 'show'])->name('asistencia.show');
    Route::post('/asistencia/{asignacion}', [AsistenciaController::class, 'store'])->name('asistencia.store');

    // --- AÑADE ESTAS DOS LÍNEAS ---
    // 1. Muestra la lista de alumnos para calificar
    Route::get('/calificaciones/{asignacion}', [CalificacionController::class, 'show'])->name('calificaciones.show');
    // 2. Guarda las calificaciones
    Route::post('/calificaciones/{asignacion}', [CalificacionController::class, 'store'])->name('calificaciones.store');

});

// --- SECCIÓN SOLO PARA ESTUDIANTES ---
Route::middleware(['auth', 'role:Estudiante'])
    ->prefix('estudiante') // <-- Añadimos prefijo
    ->name('estudiante.')  // <-- Añadimos nombre
    ->group(function () {

    // Esta será la página principal del estudiante
    Route::get('/historial', [HistorialController::class, 'index'])->name('historial.index');
    

});

// (Las rutas de 'auth' de Breeze no se tocan)
require __DIR__.'/auth.php';