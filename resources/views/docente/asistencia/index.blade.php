<x-app-layout>
    <x-slot name="header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="h2 fw-bold text-dark mb-0" style="font-family: 'Georgia', serif;">
                        Mis Clases Asignadas
                    </h1>
                    <nav aria-label="breadcrumb" class="mt-2">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Mis Clases</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-light text-dark border">
                            <i class="bi bi-calendar3 me-1"></i>
                            {{ now()->isoFormat('dddd, D [de] MMMM') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="container-fluid">
        <!-- Estadísticas Rápidas -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-primary bg-opacity-10 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="text-primary mb-2">Total Clases</h6>
                                <h3 class="fw-bold text-primary mb-0">{{ $asignaciones->count() }}</h3>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="bi bi-journal-text display-6 text-primary opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-success bg-opacity-10 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="text-success mb-2">Asistencia Hoy</h6>
                                <h3 class="fw-bold text-success mb-0">0</h3>
                                <small class="text-muted">registros</small>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="bi bi-clipboard-check display-6 text-success opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-info bg-opacity-10 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="text-info mb-2">Estudiantes</h6>
                                <h3 class="fw-bold text-info mb-0">0</h3>
                                <small class="text-muted">total</small>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="bi bi-people display-6 text-info opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-warning bg-opacity-10 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="text-warning mb-2">Pendientes</h6>
                                <h3 class="fw-bold text-warning mb-0">{{ $asignaciones->count() }}</h3>
                                <small class="text-muted">clases hoy</small>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="bi bi-clock-history display-6 text-warning opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Principal -->
        <div class="card border-0 shadow-lg">
            <div class="card-header bg-white py-4 border-0">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h5 class="card-title fw-bold mb-0" style="font-family: 'Georgia', serif;">
                            <i class="bi bi-journal-text text-primary me-2"></i>
                            Mis Materias y Grupos
                        </h5>
                        <p class="text-muted mb-0 mt-1 small">
                            Selecciona una clase para gestionar la asistencia o calificaciones
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-2 justify-content-md-end">
                            <!-- Filtros Rápidos -->
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-funnel me-1"></i>
                                    Filtrar
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Todos los grupos</a></li>
                                    <li><a class="dropdown-item" href="#">Matutino</a></li>
                                    <li><a class="dropdown-item" href="#">Vespertino</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if($asignaciones->count() > 0)
                <div class="row g-4">
                    @foreach ($asignaciones as $asignacion)
                    <div class="col-xl-4 col-lg-6">
                        <div class="card border-0 shadow-sm h-100 hover-lift">
                            <div class="card-body d-flex flex-column p-4">
                                <!-- Header de la Tarjeta -->
                                <div class="d-flex align-items-start mb-3">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3 flex-shrink-0">
                                        <i class="bi bi-journal-text text-primary fs-4"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="card-title fw-bold text-dark mb-1" style="font-family: 'Georgia', serif;">
                                            {{ $asignacion->materia->nombre_materia }}
                                        </h5>
                                        @if($asignacion->materia->clave_materia)
                                        <span class="badge bg-info bg-opacity-10 text-info border-0 small">
                                            {{ $asignacion->materia->clave_materia }}
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Información del Grupo -->
                                <div class="mb-3">
                                    <div class="row g-2">
                                        <div class="col-12">
                                            <div class="d-flex align-items-center text-muted">
                                                <i class="bi bi-collection me-2"></i>
                                                <span class="fw-medium">Grupo:</span>
                                                <span class="ms-1">{{ $asignacion->grupo->nombre_grupo }}</span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex align-items-center text-muted">
                                                <i class="bi bi-clock me-2"></i>
                                                <span class="fw-medium">Turno:</span>
                                                <span class="ms-1">
                                                    @if($asignacion->grupo->turno == 'Matutino')
                                                    <span class="badge bg-success bg-opacity-10 text-success border-0">
                                                        {{ $asignacion->grupo->turno }}
                                                    </span>
                                                    @else
                                                    <span class="badge bg-warning bg-opacity-10 text-warning border-0">
                                                        {{ $asignacion->grupo->turno }}
                                                    </span>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex align-items-center text-muted">
                                                <i class="bi bi-people me-2"></i>
                                                <span class="fw-medium">Estudiantes:</span>
                                                <span class="ms-1">25</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Estado de Asistencia Hoy -->
                                <div class="mb-3">
                                    <div class="alert alert-light border-0 small mb-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="fw-medium">Asistencia hoy:</span>
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                                No registrada
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Botones de Acción -->
                                <div class="mt-auto pt-3 border-top">
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <a href="{{ route('docente.calificaciones.show', $asignacion) }}" 
                                               class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center">
                                                <i class="bi bi-pencil-square me-2"></i>
                                                Calificar
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('docente.asistencia.show', $asignacion) }}" 
                                               class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
                                                <i class="bi bi-clipboard-check me-2"></i>
                                                Asistencia
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <!-- Estado Vacío Mejorado -->
                <div class="text-center py-5">
                    <div class="py-4">
                        <i class="bi bi-journal-x display-4 text-muted opacity-50"></i>
                        <h5 class="text-muted mt-3">No tienes clases asignadas</h5>
                        <p class="text-muted mb-4">El administrador aún no te ha asignado ninguna materia o grupo.</p>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
                                <i class="bi bi-house me-2"></i>
                                Volver al Dashboard
                            </a>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contactAdminModal">
                                <i class="bi bi-envelope me-2"></i>
                                Contactar Administrador
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal de Contacto -->
                <div class="modal fade" id="contactAdminModal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow">
                            <div class="modal-header border-0">
                                <h5 class="modal-title fw-bold">
                                    <i class="bi bi-envelope me-2"></i>
                                    Contactar Administrador
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p>Si necesitas que te asignen materias y grupos, por favor contacta al administrador del sistema.</p>
                                <div class="alert alert-info border-0 bg-info bg-opacity-10">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-info-circle me-2"></i>
                                        <div>
                                            <strong>Información de contacto</strong><br>
                                            <small class="text-muted">admin@institucion.edu • Ext. 123</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Información Adicional -->
        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="card border-0 bg-light shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold d-flex align-items-center mb-3">
                            <i class="bi bi-info-circle text-primary me-2"></i>
                            Gestión de Asistencia
                        </h6>
                        <p class="text-muted small mb-0">
                            Registra la asistencia de tus estudiantes diariamente. Puedes marcar 
                            estudiantes como Presentes, Ausentes o con Retardo. Los datos se 
                            guardan automáticamente y generan reportes mensuales.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 bg-light shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold d-flex align-items-center mb-3">
                            <i class="bi bi-lightbulb text-warning me-2"></i>
                            Consejos Rápidos
                        </h6>
                        <ul class="list-unstyled text-muted small mb-0">
                            <li class="mb-1">
                                <i class="bi bi-check text-success me-1"></i>
                                Registra la asistencia al inicio de cada clase
                            </li>
                            <li class="mb-1">
                                <i class="bi bi-check text-success me-1"></i>
                                Actualiza las calificaciones después de cada evaluación
                            </li>
                            <li>
                                <i class="bi bi-check text-success me-1"></i>
                                Revisa el historial de asistencia regularmente
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .hover-lift {
            transition: all 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
        }
    </style>
</x-app-layout>