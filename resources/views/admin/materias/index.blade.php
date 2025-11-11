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
                            <li class="breadcrumb-item active" aria-current="page">Materias</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.materias.create') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-plus-circle me-2"></i>
                        Crear Materia
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
                                <a class="nav-link d-flex align-items-center justify-content-center py-3" 
                                   href="{{ route('admin.grupos.index') }}"
                                   style="font-family: 'Georgia', serif;">
                                    <i class="bi bi-collection me-2 fs-5"></i>
                                    Grupos
                                </a>
                            </li>
                            <li class="nav-item flex-fill" role="presentation">
                                <a class="nav-link active d-flex align-items-center justify-content-center py-3" 
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
                                <h6 class="text-primary mb-2">Total Materias</h6>
                                <h3 class="fw-bold text-primary mb-0">{{ $materias->total() }}</h3>
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
                                <h6 class="text-success mb-2">Con Clave</h6>
                                <h3 class="fw-bold text-success mb-0">
                                    {{ $materias->whereNotNull('clave_materia')->count() }}
                                </h3>
                                @if($materias->count() > 0)
                                    <small class="text-muted">{{ number_format(($materias->whereNotNull('clave_materia')->count() / $materias->count()) * 100, 1) }}%</small>
                                @else
                                    <small class="text-muted">0%</small>
                                @endif
                            </div>
                            <div class="flex-shrink-0">
                                <i class="bi bi-key display-6 text-success opacity-50"></i>
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
                                <h6 class="text-info mb-2">Unidades Promedio</h6>
                                <h3 class="fw-bold text-info mb-0">
                                    {{ number_format($materias->avg('numero_unidades') ?? 0, 1) }}
                                </h3>
                                <small class="text-muted">por materia</small>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="bi bi-layer-forward display-6 text-info opacity-50"></i>
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
                                <h6 class="text-warning mb-2">Activas</h6>
                                <h3 class="fw-bold text-warning mb-0">{{ $materias->count() }}</h3>
                                <small class="text-muted">en el sistema</small>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="bi bi-check-circle display-6 text-warning opacity-50"></i>
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
                            Catálogo de Materias
                        </h5>
                        <p class="text-muted mb-0 mt-1 small">
                            Gestión del plan de estudios y asignaturas académicas
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-2 justify-content-md-end">
                            <!-- Botón Crear Materia (nuevo) -->
                            <a href="{{ route('admin.materias.create') }}" class="btn btn-primary d-flex align-items-center">
                                <i class="bi bi-plus-circle me-2"></i>
                                Crear Materia
                            </a>

                            <!-- Filtros Rápidos -->
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-funnel me-1"></i>
                                    Filtrar
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['filter' => '']) }}">Todas las materias</a></li>
                                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['filter' => 'with_key']) }}">Con clave</a></li>
                                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['filter' => 'without_key']) }}">Sin clave</a></li>
                                </ul>
                            </div>
                            
                            <!-- Búsqueda -->
                            <form method="GET" class="d-flex">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" 
                                           placeholder="Buscar materia..." value="{{ request('search') }}">
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
                @if($materias->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="ps-4" style="width: 80px;">#</th>
                                <th scope="col">Materia</th>
                                <th scope="col" class="text-center">Unidades</th>
                                <th scope="col" class="text-center">Estado</th>
                                <th scope="col" class="text-center">Grupos</th>
                                <th scope="col" class="text-end pe-4" style="width: 200px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($materias as $materia)
                                <tr class="hover-shadow">
                                    <th scope="row" class="ps-4 fw-normal text-muted">#{{ $materia->id }}</th>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                <i class="bi bi-journal-text text-primary"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold">{{ $materia->nombre_materia }}</h6>
                                                <div class="d-flex align-items-center gap-2 mt-1">
                                                    @if($materia->clave_materia)
                                                        <span class="badge bg-info bg-opacity-10 text-info border-0 small">
                                                            <i class="bi bi-key me-1"></i>
                                                            {{ $materia->clave_materia }}
                                                        </span>
                                                    @else
                                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border-0 small">
                                                            <i class="bi bi-dash-circle me-1"></i>
                                                            Sin clave
                                                        </span>
                                                    @endif
                                                    <small class="text-muted">
                                                        Creado: {{ $materia->created_at->format('d/m/Y') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex flex-column align-items-center">
                                            <span class="fw-bold text-primary fs-5">{{ $materia->numero_unidades }}</span>
                                            <div class="progress mt-1" style="height: 4px; width: 60px;">
                                                @php
                                                    $progressWidth = min(100, ($materia->numero_unidades / 10) * 100);
                                                    $progressColor = $materia->numero_unidades <= 3 ? 'bg-warning' : ($materia->numero_unidades <= 7 ? 'bg-info' : 'bg-success');
                                                @endphp
                                                <div class="progress-bar {{ $progressColor }}" 
                                                     role="progressbar" 
                                                     style="width: {{ $progressWidth }}%">
                                                </div>
                                            </div>
                                            <small class="text-muted mt-1">unidades</small>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-success bg-opacity-10 text-success border-0 py-2">
                                            <i class="bi bi-check-circle me-1"></i>
                                            Activa
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="fw-bold text-primary">0</span>
                                        <small class="text-muted d-block">grupos</small>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('admin.materias.edit', $materia) }}" 
                                               class="btn btn-sm btn-outline-primary d-flex align-items-center"
                                               data-bs-toggle="tooltip" title="Editar materia">
                                                <i class="bi bi-pencil-fill me-1"></i>
                                                Editar
                                            </a>
                                            
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-danger d-flex align-items-center"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteModal{{ $materia->id }}"
                                                    data-bs-toggle="tooltip" title="Eliminar materia">
                                                <i class="bi bi-trash-fill me-1"></i>
                                                Eliminar
                                            </button>
                                        </div>

                                        <!-- Modal de Confirmación de Eliminación -->
                                        <div class="modal fade" id="deleteModal{{ $materia->id }}" tabindex="-1">
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
                                                        <p class="mb-3">¿Estás seguro de que deseas eliminar esta materia?</p>
                                                        <div class="alert alert-warning border-0 bg-warning bg-opacity-10">
                                                            <div class="d-flex align-items-center">
                                                                <i class="bi bi-journal-text me-2"></i>
                                                                <div>
                                                                    <strong>{{ $materia->nombre_materia }}</strong><br>
                                                                    <small class="text-muted">
                                                                        @if($materia->clave_materia)
                                                                            {{ $materia->clave_materia }} • 
                                                                        @endif
                                                                        {{ $materia->numero_unidades }} unidades • ID: #{{ $materia->id }}
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p class="text-danger small mb-0">
                                                            <i class="bi bi-info-circle me-1"></i>
                                                            Esta acción no se puede deshacer. Si hay grupos asignados, no podrás eliminarla.
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer border-0">
                                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                            Cancelar
                                                        </button>
                                                        <form action="{{ route('admin.materias.destroy', $materia) }}" method="POST" class="d-inline">
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
                        <i class="bi bi-journal-x display-4 text-muted opacity-50"></i>
                        <h5 class="text-muted mt-3">No hay materias registradas</h5>
                        <p class="text-muted mb-4">Comienza creando la primera materia del plan de estudios.</p>
                        <a href="{{ route('admin.materias.create') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-plus-circle me-2"></i>
                            Crear Primera Materia
                        </a>
                    </div>
                </div>
                @endif

                <!-- Paginación Mejorada -->
                @if ($materias->hasPages())
                    <div class="card-footer bg-white border-0 py-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <p class="text-muted mb-0 small">
                                    Mostrando {{ $materias->firstItem() }} - {{ $materias->lastItem() }} de {{ $materias->total() }} resultados
                                </p>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-md-end">
                                    {{ $materias->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Información Adicional -->
        <div class="row mt-4">
            <div class="col-lg-4">
                <div class="card border-0 bg-light shadow-sm">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-info-circle display-4 text-primary opacity-50 mb-3"></i>
                        <h6 class="fw-bold">Estructura Curricular</h6>
                        <p class="text-muted small mb-0">
                            Las materias representan las asignaturas del plan de estudios. Cada una puede tener diferentes unidades de aprendizaje.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 bg-light shadow-sm">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-lightbulb display-4 text-warning opacity-50 mb-3"></i>
                        <h6 class="fw-bold">Claves de Materia</h6>
                        <p class="text-muted small mb-0">
                            Las claves ayudan a identificar rápidamente las materias. Usa un formato consistente como "SCB-1025".
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 bg-light shadow-sm">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-shield-check display-4 text-success opacity-50 mb-3"></i>
                        <h6 class="fw-bold">Unidades de Aprendizaje</h6>
                        <p class="text-muted small mb-0">
                            Define el número de unidades para organizar el contenido académico. Lo típico es entre 3 y 10 unidades por materia.
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