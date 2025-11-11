<x-app-layout>
    <x-slot name="header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="h2 fw-bold text-dark mb-0" style="font-family: 'Georgia', serif;">
                        Gestión de Asignaciones
                    </h1>
                    <nav aria-label="breadcrumb" class="mt-2">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Asignaciones</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.asignaciones.create') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-link-45deg me-2"></i>
                        Crear Asignación
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="container-fluid">
        <!-- Alertas Mejoradas -->
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

        <!-- Estadísticas Rápidas -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-primary bg-opacity-10 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="text-primary mb-2">Total Asignaciones</h6>
                                <h3 class="fw-bold text-primary mb-0">{{ $asignaciones->total() }}</h3>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="bi bi-link-45deg display-6 text-primary opacity-50"></i>
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
                                <h6 class="text-success mb-2">Docentes Activos</h6>
                                <h3 class="fw-bold text-success mb-0">
                                    {{ $asignaciones->unique('docente_id')->count() }}
                                </h3>
                                <small class="text-muted">con asignaciones</small>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="bi bi-person-check display-6 text-success opacity-50"></i>
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
                                <h6 class="text-info mb-2">Materias Asignadas</h6>
                                <h3 class="fw-bold text-info mb-0">
                                    {{ $asignaciones->unique('materia_id')->count() }}
                                </h3>
                                <small class="text-muted">en uso</small>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="bi bi-journal-text display-6 text-info opacity-50"></i>
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
                                <h6 class="text-warning mb-2">Grupos Activos</h6>
                                <h3 class="fw-bold text-warning mb-0">
                                    {{ $asignaciones->unique('grupo_id')->count() }}
                                </h3>
                                <small class="text-muted">con materias</small>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="bi bi-collection display-6 text-warning opacity-50"></i>
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
                            <i class="bi bi-link-45deg text-primary me-2"></i>
                            Asignaciones Académicas
                        </h5>
                        <p class="text-muted mb-0 mt-1 small">
                            Relación entre docentes, materias y grupos
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-2 justify-content-md-end">
                            <!-- Botón Crear Asignación (nuevo) -->
                            <a href="{{ route('admin.asignaciones.create') }}" class="btn btn-primary d-flex align-items-center">
                                <i class="bi bi-link-45deg me-2"></i>
                                Crear Asignación
                            </a>

                            <!-- Filtros Rápidos -->
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-funnel me-1"></i>
                                    Filtrar
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['filter' => '']) }}">Todas las asignaciones</a></li>
                                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['filter' => 'by_teacher']) }}">Por docente</a></li>
                                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['filter' => 'by_group']) }}">Por grupo</a></li>
                                </ul>
                            </div>
                            
                            <!-- Búsqueda -->
                            <form method="GET" class="d-flex">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" 
                                           placeholder="Buscar asignación..." value="{{ request('search') }}">
                                    <button class="btn btn-outline-primary" type="submit">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                @if($asignaciones->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="ps-4">Asignación</th>
                                <th scope="col">Docente</th>
                                <th scope="col">Materia</th>
                                <th scope="col">Grupo</th>
                                <th scope="col" class="text-center">Estado</th>
                                <th scope="col" class="text-end pe-4" style="width: 180px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($asignaciones as $asignacion)
                                <tr class="hover-shadow">
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                <i class="bi bi-link-45deg text-primary"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold text-primary">Asignación #{{ $asignacion->id }}</h6>
                                                <small class="text-muted">
                                                    Creada: {{ $asignacion->created_at->format('d/m/Y') }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-success bg-opacity-10 rounded-circle p-1 me-2">
                                                <i class="bi bi-person-check text-success"></i>
                                            </div>
                                            <div>
                                                <span class="fw-medium">{{ $asignacion->docente->user->nombre }} {{ $asignacion->docente->user->apellido_paterno }}</span>
                                                <br>
                                                <small class="text-muted">Docente</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-info bg-opacity-10 rounded-circle p-1 me-2">
                                                <i class="bi bi-journal-text text-info"></i>
                                            </div>
                                            <div>
                                                <span class="fw-medium">{{ $asignacion->materia->nombre_materia }}</span>
                                                <br>
                                                <small class="text-muted">
                                                    @if($asignacion->materia->clave_materia)
                                                        {{ $asignacion->materia->clave_materia }}
                                                    @else
                                                        Sin clave
                                                    @endif
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-warning bg-opacity-10 rounded-circle p-1 me-2">
                                                <i class="bi bi-collection text-warning"></i>
                                            </div>
                                            <div>
                                                <span class="fw-medium">{{ $asignacion->grupo->nombre_grupo }}</span>
                                                <br>
                                                <small class="text-muted">{{ $asignacion->grupo->turno }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-success bg-opacity-10 text-success border-0 py-2">
                                            <i class="bi bi-check-circle me-1"></i>
                                            Activa
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('admin.asignaciones.edit', $asignacion) }}" 
                                               class="btn btn-sm btn-outline-primary d-flex align-items-center"
                                               data-bs-toggle="tooltip" title="Editar asignación">
                                                <i class="bi bi-pencil-fill me-1"></i>
                                                Editar
                                            </a>
                                            
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-danger d-flex align-items-center"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteModal{{ $asignacion->id }}"
                                                    data-bs-toggle="tooltip" title="Eliminar asignación">
                                                <i class="bi bi-trash-fill me-1"></i>
                                                Eliminar
                                            </button>
                                        </div>

                                        <!-- Modal de Confirmación de Eliminación -->
                                        <div class="modal fade" id="deleteModal{{ $asignacion->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border-0 shadow">
                                                    <div class="modal-header border-0 bg-danger bg-opacity-10">
                                                        <h5 class="modal-title fw-bold text-danger">
                                                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                                            Confirmar Eliminación
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="mb-3 fw-semibold">¿Estás seguro de que deseas eliminar esta asignación?</p>
                                                        
                                                        <div class="alert alert-warning border-0 bg-warning bg-opacity-10 mb-3">
                                                            <div class="row g-2">
                                                                <div class="col-12">
                                                                    <div class="d-flex align-items-center mb-2">
                                                                        <i class="bi bi-person-check text-success me-2"></i>
                                                                        <div>
                                                                            <strong>Docente:</strong><br>
                                                                            <small>{{ $asignacion->docente->user->nombre }} {{ $asignacion->docente->user->apellido_paterno }}</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="d-flex align-items-center mb-2">
                                                                        <i class="bi bi-journal-text text-info me-2"></i>
                                                                        <div>
                                                                            <strong>Materia:</strong><br>
                                                                            <small>{{ $asignacion->materia->nombre_materia }}</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="d-flex align-items-center">
                                                                        <i class="bi bi-collection text-warning me-2"></i>
                                                                        <div>
                                                                            <strong>Grupo:</strong><br>
                                                                            <small>{{ $asignacion->grupo->nombre_grupo }} ({{ $asignacion->grupo->turno }})</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="alert alert-danger border-0 bg-danger bg-opacity-10 mb-3">
                                                            <h6 class="fw-bold text-danger mb-2">
                                                                <i class="bi bi-exclamation-circle me-1"></i>
                                                                Importante:
                                                            </h6>
                                                            <p class="mb-0 small">
                                                                Se eliminarán todos los registros asociados a esta asignación, incluyendo asistencias y calificaciones. Esta acción no se puede deshacer.
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer border-0">
                                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                            Cancelar
                                                        </button>
                                                        <form action="{{ route('admin.asignaciones.destroy', $asignacion) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">
                                                                <i class="bi bi-trash-fill me-1"></i>
                                                                Sí, Eliminar
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <!-- Estado Vacío Mejorado -->
                <div class="text-center py-5">
                    <div class="py-4">
                        <i class="bi bi-link-45deg display-4 text-muted opacity-50"></i>
                        <h5 class="text-muted mt-3">No hay asignaciones registradas</h5>
                        <p class="text-muted mb-4">Comienza creando la primera asignación académica.</p>
                        <a href="{{ route('admin.asignaciones.create') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-link-45deg me-2"></i>
                            Crear Primera Asignación
                        </a>
                    </div>
                </div>
                @endif

                <!-- Paginación Mejorada -->
                @if ($asignaciones->hasPages())
                    <div class="card-footer bg-white border-0 py-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <p class="text-muted mb-0 small">
                                    Mostrando {{ $asignaciones->firstItem() }} - {{ $asignaciones->lastItem() }} de {{ $asignaciones->total() }} resultados
                                </p>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-md-end">
                                    {{ $asignaciones->links('pagination::bootstrap-5') }}
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
                            ¿Qué son las asignaciones académicas?
                        </h6>
                        <p class="text-muted small mb-0">
                            Las asignaciones conectan docentes con materias y grupos específicos. 
                            Establecen qué profesor imparte qué materia a qué grupo de estudiantes, 
                            organizando así la distribución de la carga académica.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 bg-light shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold d-flex align-items-center mb-3">
                            <i class="bi bi-lightbulb text-warning me-2"></i>
                            Buenas Prácticas
                        </h6>
                        <p class="text-muted small mb-0">
                            Evita asignar el mismo docente a múltiples grupos en el mismo horario. 
                            Mantén un balance equitativo de carga académica entre los docentes 
                            y verifica que no existan conflictos de horarios.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .hover-shadow:hover {
            box-shadow: inset 0 0 0 1px var(--bs-primary), 0 2px 8px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
    </style>

    <script>
        // Inicializar tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>
</x-app-layout>