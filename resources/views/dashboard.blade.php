<x-app-layout>
    <x-slot name="header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="h2 fw-bold text-dark mb-0" style="font-family: 'Georgia', serif;">
                        Dashboard
                    </h1>
                    <nav aria-label="breadcrumb" class="mt-2">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item active" aria-current="page">
                                <i class="bi bi-house-fill me-1"></i>
                                Inicio
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-light text-dark border">
                            <i class="bi bi-calendar3 me-1"></i>
                            {{ now()->format('d M, Y') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="container-fluid">
        <!-- Alertas de Sesión -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                    <div class="flex-grow-1">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-exclamation-circle-fill me-2 fs-5"></i>
                    <div class="flex-grow-1">
                        {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <!-- Welcome Card -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 bg-gradient-primary text-white shadow-lg overflow-hidden">
                    <div class="card-body p-4 p-lg-5 position-relative">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <div class="position-relative z-1">
                                    <h2 class="h3 fw-bold mb-2" style="font-family: 'Georgia', serif;">
                                        ¡Bienvenido de vuelta, {{ Auth::user()->nombre }}!
                                    </h2>
                                    <p class="mb-3 opacity-90 lead">
                                        {{ Auth::user()->isAdministrador() ? 'Gestión completa del sistema académico' : (Auth::user()->isDocente() ? 'Controla tus clases y estudiantes' : 'Revisa tu progreso académico') }}
                                    </p>
                                    <div class="d-flex flex-wrap gap-2 align-items-center">
                                        <span class="badge bg-black bg-opacity-20 text-white border-0 py-2 px-3">
                                            <i class="bi bi-person-badge me-1"></i>
                                            <span class="fw-bold">
                                                @if(Auth::user()->isAdministrador())
                                                    Rol: Administrador
                                                @elseif(Auth::user()->isDocente())
                                                    Rol: Docente
                                                @elseif(Auth::user()->isEstudiante())
                                                    Rol: Estudiante
                                                @endif
                                            </span>
                                        </span>
                                        <span class="badge bg-black bg-opacity-20 text-white border-0 py-2 px-3">
                                            <i class="bi bi-calendar-check me-1"></i>
                                            <span class="fw-bold">Último acceso: {{ Auth::user()->updated_at->format('d/m/Y') }}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 text-center text-lg-end mt-4 mt-lg-0">
                                <div class="position-relative z-1">
                                    <i class="bi bi-graph-up-arrow display-1 opacity-25"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Background Pattern -->
                        <div class="position-absolute top-0 end-0 w-50 h-100 opacity-10">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dashboard Content by Role -->
        @if(Auth::user()->isAdministrador())
            <!-- ADMINISTRATOR DASHBOARD -->
            <div class="row g-4">
                <!-- Statistics Cards -->
                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100 hover-lift">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="text-muted mb-2">Total Usuarios</h6>
                                    <h3 class="fw-bold text-primary mb-0">{{ number_format($usersCount ?? 0) }}</h3>
                                    <span class="text-success small">
                                        <i class="bi bi-arrow-up-short"></i>
                                        12% este mes
                                    </span>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                                        <i class="bi bi-people-fill text-primary fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100 hover-lift">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="text-muted mb-2">Docentes Activos</h6>
                                    <h3 class="fw-bold text-success mb-0">{{ number_format($docentesModelCount ?? ($docentesCount ?? 0)) }}</h3>
                                    <span class="text-success small">
                                        <i class="bi bi-arrow-up-short"></i>
                                        5% este mes
                                    </span>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                                        <i class="bi bi-person-check text-success fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100 hover-lift">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="text-muted mb-2">Estudiantes</h6>
                                    <h3 class="fw-bold text-info mb-0">{{ number_format($estudiantesModelCount ?? ($estudiantesCount ?? 0)) }}</h3>
                                    <span class="text-success small">
                                        <i class="bi bi-arrow-up-short"></i>
                                        8% este mes
                                    </span>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="bg-info bg-opacity-10 p-3 rounded-circle">
                                        <i class="bi bi-mortarboard text-info fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100 hover-lift">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="text-muted mb-2">Materias Activas</h6>
                                    <h3 class="fw-bold text-warning mb-0">{{ number_format($materiasCount ?? 0) }}</h3>
                                    <span class="text-muted small">
                                        <i class="bi bi-dash"></i>
                                        Sin cambios
                                    </span>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                                        <i class="bi bi-journal-text text-warning fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="fw-bold mb-0" style="font-family: 'Georgia', serif;">
                                <i class="bi bi-lightning-fill text-warning me-2"></i>
                                Acciones Rápidas
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <a href="{{ route('admin.usuarios.index') }}" class="card border-0 bg-light text-decoration-none hover-lift h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="bg-primary bg-opacity-10 p-3 rounded-circle d-inline-flex mb-3">
                                                <i class="bi bi-people-fill text-primary fs-2"></i>
                                            </div>
                                            <h6 class="fw-bold text-dark">Gestión de Usuarios</h6>
                                            <p class="text-muted small mb-0">Administrar todos los usuarios del sistema</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('admin.semestres.index') }}" class="card border-0 bg-light text-decoration-none hover-lift h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="bg-success bg-opacity-10 p-3 rounded-circle d-inline-flex mb-3">
                                                <i class="bi bi-calendar-range text-success fs-2"></i>
                                            </div>
                                            <h6 class="fw-bold text-dark">Gestión Académica</h6>
                                            <p class="text-muted small mb-0">Semestres, grupos y materias</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('admin.asignaciones.index') }}" class="card border-0 bg-light text-decoration-none hover-lift h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="bg-info bg-opacity-10 p-3 rounded-circle d-inline-flex mb-3">
                                                <i class="bi bi-clipboard-check text-info fs-2"></i>
                                            </div>
                                            <h6 class="fw-bold text-dark">Asignaciones</h6>
                                            <p class="text-muted small mb-0">Gestionar asignaciones docentes</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#" class="card border-0 bg-light text-decoration-none hover-lift h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="bg-warning bg-opacity-10 p-3 rounded-circle d-inline-flex mb-3">
                                                <i class="bi bi-graph-up text-warning fs-2"></i>
                                            </div>
                                            <h6 class="fw-bold text-dark">Reportes</h6>
                                            <p class="text-muted small mb-0">Generar reportes del sistema</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="fw-bold mb-0" style="font-family: 'Georgia', serif;">
                                <i class="bi bi-clock-history text-primary me-2"></i>
                                Actividad Reciente
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item px-0 border-0">
                                    <div class="d-flex align-items-start">
                                        <div class="bg-success bg-opacity-10 p-2 rounded me-3">
                                            <i class="bi bi-person-plus text-success"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 small fw-bold">Nuevo usuario registrado</h6>
                                            <p class="mb-0 text-muted small">Juan Pérez se unió como estudiante</p>
                                            <small class="text-muted">Hace 2 horas</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item px-0 border-0">
                                    <div class="d-flex align-items-start">
                                        <div class="bg-info bg-opacity-10 p-2 rounded me-3">
                                            <i class="bi bi-journal-check text-info"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 small fw-bold">Asistencia registrada</h6>
                                            <p class="mb-0 text-muted small">Matemáticas II - Grupo A</p>
                                            <small class="text-muted">Hace 4 horas</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item px-0 border-0">
                                    <div class="d-flex align-items-start">
                                        <div class="bg-warning bg-opacity-10 p-2 rounded me-3">
                                            <i class="bi bi-exclamation-triangle text-warning"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 small fw-bold">Advertencia del sistema</h6>
                                            <p class="mb-0 text-muted small">Backup pendiente de ejecutar</p>
                                            <small class="text-muted">Ayer a las 18:30</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @elseif(Auth::user()->isDocente())
            <!-- TEACHER DASHBOARD -->
            <div class="row g-4">
                <!-- Teacher Statistics -->
                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100 hover-lift">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="text-muted mb-2">Clases Hoy</h6>
                                    <h3 class="fw-bold text-primary mb-0">{{ $docente_clases ?? 0 }}</h3>
                                    <span class="text-muted small">Próxima: 10:00 AM</span>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                                        <i class="bi bi-calendar-check text-primary fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100 hover-lift">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="text-muted mb-2">Estudiantes</h6>
                                    <h3 class="fw-bold text-success mb-0">{{ number_format($docente_estudiantes ?? 0) }}</h3>
                                    <span class="text-success small">
                                        <i class="bi bi-check-circle"></i>
                                        Todos activos
                                    </span>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                                        <i class="bi bi-people text-success fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100 hover-lift">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="text-muted mb-2">Asistencia Pendiente</h6>
                                    <h3 class="fw-bold text-warning mb-0">{{ $docente_asistencia_pendiente ?? 0 }}</h3>
                                    <span class="text-warning small">Por tomar hoy</span>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                                        <i class="bi bi-clipboard-data text-warning fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100 hover-lift">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="text-muted mb-2">Calificaciones Pendientes</h6>
                                    <h3 class="fw-bold text-info mb-0">{{ $docente_calificaciones_pendientes ?? 0 }}</h3>
                                    <span class="text-info small">Por registrar</span>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="bg-info bg-opacity-10 p-3 rounded-circle">
                                        <i class="bi bi-pencil-square text-info fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions for Teachers -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="fw-bold mb-0" style="font-family: 'Georgia', serif;">
                                <i class="bi bi-lightning-fill text-warning me-2"></i>
                                Acciones Inmediatas
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <a href="{{ route('docente.asistencia.index') }}" class="card border-0 bg-light text-decoration-none hover-lift h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="bg-primary bg-opacity-10 p-3 rounded-circle d-inline-flex mb-3">
                                                <i class="bi bi-clipboard-check text-primary fs-2"></i>
                                            </div>
                                            <h6 class="fw-bold text-dark">Tomar Asistencia</h6>
                                            <p class="text-muted small mb-0">Registrar asistencia de clases</p>
                                            <span class="badge bg-warning text-dark mt-2">{{ $docente_asistencia_pendiente ?? 0 }} pendientes</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#" class="card border-0 bg-light text-decoration-none hover-lift h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="bg-success bg-opacity-10 p-3 rounded-circle d-inline-flex mb-3">
                                                <i class="bi bi-pencil-square text-success fs-2"></i>
                                            </div>
                                            <h6 class="fw-bold text-dark">Registrar Calificaciones</h6>
                                            <p class="text-muted small mb-0">Ingresar calificaciones de exámenes</p>
                                            <span class="badge bg-info text-dark mt-2">{{ $docente_calificaciones_pendientes ?? 0 }} pendientes</span>
                                        </div>
                                    </a>
                                </div>
        
                                
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Today's Schedule -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="fw-bold mb-0" style="font-family: 'Georgia', serif;">
                                <i class="bi bi-calendar-day text-primary me-2"></i>
                                Horario de Hoy
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item px-0 border-0 bg-success bg-opacity-5 rounded mb-2">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-1 small fw-bold">Matemáticas II</h6>
                                            <p class="mb-0 text-muted small">Grupo A - Salón 304</p>
                                        </div>
                                        <span class="badge bg-success">08:00 - 10:00</span>
                                    </div>
                                </div>
                                <div class="list-group-item px-0 border-0 bg-warning bg-opacity-5 rounded mb-2">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-1 small fw-bold">Física I</h6>
                                            <p class="mb-0 text-muted small">Grupo B - Salón 205</p>
                                        </div>
                                        <span class="badge bg-warning text-dark">10:30 - 12:30</span>
                                    </div>
                                </div>
                                <div class="list-group-item px-0 border-0 bg-info bg-opacity-5 rounded">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-1 small fw-bold">Matemáticas II</h6>
                                            <p class="mb-0 text-muted small">Grupo C - Salón 304</p>
                                        </div>
                                        <span class="badge bg-info">14:00 - 16:00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @elseif(Auth::user()->isEstudiante())
            <!-- STUDENT DASHBOARD -->
            <div class="row g-4">
                <!-- Student Statistics -->
                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100 hover-lift">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="text-muted mb-2">Promedio General</h6>
                                    <h3 class="fw-bold text-primary mb-0">8.7</h3>
                                    <span class="text-success small">
                                        <i class="bi bi-arrow-up-short"></i>
                                        0.2 este semestre
                                    </span>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                                        <i class="bi bi-graph-up text-primary fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100 hover-lift">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="text-muted mb-2">Asistencia</h6>
                                    <h3 class="fw-bold text-success mb-0">94%</h3>
                                    <span class="text-success small">
                                        <i class="bi bi-check-circle"></i>
                                        Excelente
                                    </span>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                                        <i class="bi bi-clipboard-check text-success fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100 hover-lift">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="text-muted mb-2">Materias Inscritas</h6>
                                    <h3 class="fw-bold text-info mb-0">6</h3>
                                    <span class="text-muted small">Este semestre</span>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="bg-info bg-opacity-10 p-3 rounded-circle">
                                        <i class="bi bi-journal-text text-info fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100 hover-lift">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="text-muted mb-2">Tareas Pendientes</h6>
                                    <h3 class="fw-bold text-warning mb-0">3</h3>
                                    <span class="text-warning small">Por entregar</span>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                                        <i class="bi bi-clock text-warning fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions for Students -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="fw-bold mb-0" style="font-family: 'Georgia', serif;">
                                <i class="bi bi-lightning-fill text-warning me-2"></i>
                                Acciones Rápidas
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <a href="{{ route('estudiante.historial.index') }}" class="card border-0 bg-light text-decoration-none hover-lift h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="bg-primary bg-opacity-10 p-3 rounded-circle d-inline-flex mb-3">
                                                <i class="bi bi-journal-text text-primary fs-2"></i>
                                            </div>
                                            <h6 class="fw-bold text-dark">Mi Historial</h6>
                                            <p class="text-muted small mb-0">Ver calificaciones y progreso</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#" class="card border-0 bg-light text-decoration-none hover-lift h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="bg-success bg-opacity-10 p-3 rounded-circle d-inline-flex mb-3">
                                                <i class="bi bi-calendar-week text-success fs-2"></i>
                                            </div>
                                            <h6 class="fw-bold text-dark">Horario</h6>
                                            <p class="text-muted small mb-0">Consultar horario de clases</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#" class="card border-0 bg-light text-decoration-none hover-lift h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="bg-info bg-opacity-10 p-3 rounded-circle d-inline-flex mb-3">
                                                <i class="bi bi-clipboard-data text-info fs-2"></i>
                                            </div>
                                            <h6 class="fw-bold text-dark">Asistencia</h6>
                                            <p class="text-muted small mb-0">Revisar registro de asistencias</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#" class="card border-0 bg-light text-decoration-none hover-lift h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="bg-warning bg-opacity-10 p-3 rounded-circle d-inline-flex mb-3">
                                                <i class="bi bi-book text-warning fs-2"></i>
                                            </div>
                                            <h6 class="fw-bold text-dark">Materiales</h6>
                                            <p class="text-muted small mb-0">Acceder a materiales de clase</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Today's Classes -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="fw-bold mb-0" style="font-family: 'Georgia', serif;">
                                <i class="bi bi-calendar-day text-primary me-2"></i>
                                Clases de Hoy
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item px-0 border-0 bg-success bg-opacity-5 rounded mb-2">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-1 small fw-bold">Matemáticas II</h6>
                                            <p class="mb-0 text-muted small">Prof. González - Salón 304</p>
                                        </div>
                                        <span class="badge bg-success">08:00 - 10:00</span>
                                    </div>
                                </div>
                                <div class="list-group-item px-0 border-0 bg-primary bg-opacity-5 rounded mb-2">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-1 small fw-bold">Programación</h6>
                                            <p class="mb-0 text-muted small">Prof. Rodríguez - Lab 101</p>
                                        </div>
                                        <span class="badge bg-primary">10:30 - 12:30</span>
                                    </div>
                                </div>
                                <div class="list-group-item px-0 border-0 bg-info bg-opacity-5 rounded">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-1 small fw-bold">Base de Datos</h6>
                                            <p class="mb-0 text-muted small">Prof. Martínez - Salón 205</p>
                                        </div>
                                        <span class="badge bg-info">14:00 - 16:00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <style>
        .hover-lift {
            transition: all 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
        }
        .bg-gradient-primary {
            background: linear-gradient(135deg, var(--bs-primary) 0%, #6EB4C1 100%) !important;
        }
    </style>
</x-app-layout>