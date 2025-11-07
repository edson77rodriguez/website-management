<x-app-layout>
    <x-slot name="header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="h2 fw-bold text-dark mb-0" style="font-family: 'Georgia', serif;">
                        Gestión Académica
                    </h1>
                    <nav aria-label="breadcrumb" class="mt-2">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Grupos</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.grupos.create') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-plus-circle me-2"></i>
                        Crear Grupo
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="container-fluid">
        <!-- Navigation Tabs Mejoradas -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <ul class="nav nav-pills nav-justified gap-2 p-3" id="academicTabs" role="tablist">
                            <li class="nav-item flex-fill" role="presentation">
                                <a class="nav-link d-flex align-items-center justify-content-center py-3" 
                                   href="{{ route('admin.semestres.index') }}"
                                   style="font-family: 'Georgia', serif;">
                                    <i class="bi bi-calendar-range me-2 fs-5"></i>
                                    Semestres
                                </a>
                            </li>
                            <li class="nav-item flex-fill" role="presentation">
                                <a class="nav-link active d-flex align-items-center justify-content-center py-3" 
                                   href="{{ route('admin.grupos.index') }}"
                                   style="font-family: 'Georgia', serif;">
                                    <i class="bi bi-collection me-2 fs-5"></i>
                                    Grupos
                                </a>
                            </li>
                            <li class="nav-item flex-fill" role="presentation">
                                <a class="nav-link d-flex align-items-center justify-content-center py-3" 
                                   href="{{ route('admin.materias.index') }}"
                                   style="font-family: 'Georgia', serif;">
                                    <i class="bi bi-journal-text me-2 fs-5"></i>
                                    Materias
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

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
                                <h6 class="text-primary mb-2">Total Grupos</h6>
                                <h3 class="fw-bold text-primary mb-0">{{ $grupos->total() }}</h3>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="bi bi-collection display-6 text-primary opacity-50"></i>
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
                                <h6 class="text-success mb-2">Grupos Matutinos</h6>
                                <h3 class="fw-bold text-success mb-0">
                                    {{ $grupos->where('turno', 'Matutino')->count() }}
                                </h3>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="bi bi-sun display-6 text-success opacity-50"></i>
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
                                <h6 class="text-warning mb-2">Grupos Vespertinos</h6>
                                <h3 class="fw-bold text-warning mb-0">
                                    {{ $grupos->where('turno', 'Vespertino')->count() }}
                                </h3>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="bi bi-moon display-6 text-warning opacity-50"></i>
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
                                <h6 class="text-info mb-2">Capacidad Promedio</h6>
                                <h3 class="fw-bold text-info mb-0">25</h3>
                                <small class="text-muted">estudiantes/grupo</small>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="bi bi-people display-6 text-info opacity-50"></i>
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
                            <i class="bi bi-collection text-primary me-2"></i>
                            Catálogo de Grupos
                        </h5>
                        <p class="text-muted mb-0 mt-1 small">
                            Gestión de grupos académicos para organización estudiantil
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-2 justify-content-md-end">
                            <!-- Botón Crear Grupo (nuevo) -->
                            <a href="{{ route('admin.grupos.create') }}" class="btn btn-primary d-flex align-items-center">
                                <i class="bi bi-plus-circle me-2"></i>
                                Crear Grupo
                            </a>

                            <!-- Filtros Rápidos -->
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-funnel me-1"></i>
                                    Filtrar por Turno
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['turno' => '']) }}">Todos los turnos</a></li>
                                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['turno' => 'Matutino']) }}">Matutino</a></li>
                                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['turno' => 'Vespertino']) }}">Vespertino</a></li>
                                </ul>
                            </div>
                            
                            <!-- Búsqueda -->
                            <form method="GET" class="d-flex">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" 
                                           placeholder="Buscar grupo..." value="{{ request('search') }}">
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
                @if($grupos->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="ps-4" style="width: 80px;">#</th>
                                <th scope="col">Grupo</th>
                                <th scope="col">Turno</th>
                                <th scope="col" class="text-center">Estudiantes</th>
                                <th scope="col" class="text-center">Capacidad</th>
                                <th scope="col" class="text-center">Estado</th>
                                <th scope="col" class="text-end pe-4" style="width: 200px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grupos as $grupo)
                                <tr class="hover-shadow">
                                    <th scope="row" class="ps-4 fw-normal text-muted">#{{ $grupo->id }}</th>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                <i class="bi bi-collection text-primary"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold">{{ $grupo->nombre_grupo }}</h6>
                                                <small class="text-muted">
                                                    Creado: {{ $grupo->created_at->format('d/m/Y') }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($grupo->turno == 'Matutino')
                                            <span class="badge bg-success bg-opacity-10 text-success border-0 py-2 px-3">
                                                <i class="bi bi-sun me-1"></i>
                                                {{ $grupo->turno }}
                                            </span>
                                        @else
                                            <span class="badge bg-warning bg-opacity-10 text-warning border-0 py-2 px-3">
                                                <i class="bi bi-moon me-1"></i>
                                                {{ $grupo->turno }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="fw-bold text-primary">0</span>
                                        <small class="text-muted d-block">estudiantes</small>
                                    </td>
                                    <td class="text-center">
                                        <div class="progress" style="height: 6px; width: 80px; margin: 0 auto;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 0%"></div>
                                        </div>
                                        <small class="text-muted">0/25</small>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-success bg-opacity-10 text-success border-0 py-2">
                                            <i class="bi bi-check-circle me-1"></i>
                                            Activo
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('admin.grupos.edit', $grupo) }}" 
                                               class="btn btn-sm btn-outline-primary d-flex align-items-center"
                                               data-bs-toggle="tooltip" title="Editar grupo">
                                                <i class="bi bi-pencil-fill me-1"></i>
                                                Editar
                                            </a>
                                            
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-danger d-flex align-items-center"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteModal{{ $grupo->id }}"
                                                    data-bs-toggle="tooltip" title="Eliminar grupo">
                                                <i class="bi bi-trash-fill me-1"></i>
                                                Eliminar
                                            </button>
                                        </div>

                                        <!-- Modal de Confirmación de Eliminación -->
                                        <div class="modal fade" id="deleteModal{{ $grupo->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border-0 shadow">
                                                    <div class="modal-header border-0">
                                                        <h5 class="modal-title fw-bold text-danger">
                                                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                                            Confirmar Eliminación
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="mb-3">¿Estás seguro de que deseas eliminar este grupo?</p>
                                                        <div class="alert alert-warning border-0 bg-warning bg-opacity-10">
                                                            <div class="d-flex align-items-center">
                                                                <i class="bi bi-collection me-2"></i>
                                                                <div>
                                                                    <strong>{{ $grupo->nombre_grupo }}</strong><br>
                                                                    <small class="text-muted">{{ $grupo->turno }} • ID: #{{ $grupo->id }}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p class="text-danger small mb-0">
                                                            <i class="bi bi-info-circle me-1"></i>
                                                            Esta acción no se puede deshacer. Si hay estudiantes asignados, no podrás eliminarlo.
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer border-0">
                                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                            Cancelar
                                                        </button>
                                                        <form action="{{ route('admin.grupos.destroy', $grupo) }}" method="POST" class="d-inline">
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
                        <i class="bi bi-collection display-4 text-muted opacity-50"></i>
                        <h5 class="text-muted mt-3">No hay grupos registrados</h5>
                        <p class="text-muted mb-4">Comienza creando el primer grupo académico.</p>
                        <a href="{{ route('admin.grupos.create') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-plus-circle me-2"></i>
                            Crear Primer Grupo
                        </a>
                    </div>
                </div>
                @endif

                <!-- Paginación Mejorada -->
                @if ($grupos->hasPages())
                    <div class="card-footer bg-white border-0 py-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <p class="text-muted mb-0 small">
                                    Mostrando {{ $grupos->firstItem() }} - {{ $grupos->lastItem() }} de {{ $grupos->total() }} resultados
                                </p>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-md-end">
                                    {{ $grupos->links('pagination::bootstrap-5') }}
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
                            ¿Qué son los grupos académicos?
                        </h6>
                        <p class="text-muted small mb-0">
                            Los grupos representan secciones de estudiantes dentro de un mismo semestre. 
                            Permiten organizar a los estudiantes en unidades manejables para la administración 
                            de clases, asignación de docentes y control de asistencia.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 bg-light shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold d-flex align-items-center mb-3">
                            <i class="bi bi-lightbulb text-warning me-2"></i>
                            Convención de Nombres
                        </h6>
                        <p class="text-muted small mb-0">
                            Usa nombres descriptivos como "ISC-701", "ING-402" donde las siglas representan 
                            la carrera y los números el semestre y sección. Esto facilita la identificación 
                            y organización de los grupos.
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
        .nav-pills .nav-link {
            border-radius: 0.75rem;
            transition: all 0.3s ease;
        }
        .nav-pills .nav-link.active {
            background: linear-gradient(135deg, var(--bs-primary) 0%, #6EB4C1 100%);
            box-shadow: 0 4px 15px rgba(var(--bs-primary-rgb), 0.3);
        }
        .nav-pills .nav-link:not(.active):hover {
            background-color: rgba(var(--bs-primary-rgb), 0.1);
            transform: translateY(-2px);
        }
        .progress {
            background-color: var(--bs-light);
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