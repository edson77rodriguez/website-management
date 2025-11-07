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
                            <li class="breadcrumb-item active" aria-current="page">Semestres</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.semestres.create') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-plus-circle me-2"></i>
                        Crear Semestre
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
                                <a class="nav-link active d-flex align-items-center justify-content-center py-3" 
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

        <!-- Card Principal -->
        <div class="card border-0 shadow-lg">
            <div class="card-header bg-white py-4 border-0">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h5 class="card-title fw-bold mb-0" style="font-family: 'Georgia', serif;">
                            <i class="bi bi-calendar-range text-primary me-2"></i>
                            Catálogo de Semestres
                        </h5>
                        <p class="text-muted mb-0 mt-1 small">
                            Total: {{ $semestres->total() }} semestres registrados
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-2 justify-content-md-end">
                            <!-- Botón Crear Semestre junto a la búsqueda -->
                            <a href="{{ route('admin.semestres.create') }}" class="btn btn-primary d-flex align-items-center">
                                <i class="bi bi-plus-circle me-2"></i>
                                Crear Semestre
                            </a>

                            <!-- Búsqueda -->
                            <form method="GET" class="d-flex">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" 
                                           placeholder="Buscar semestre..." value="{{ request('search') }}">
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
                @if($semestres->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="ps-4" style="width: 80px;">#</th>
                                <th scope="col">Semestre</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="text-center">Estudiantes</th>
                                <th scope="col" class="text-center">Grupos</th>
                                <th scope="col" class="text-end pe-4" style="width: 200px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semestres as $semestre)
                                <tr class="hover-shadow">
                                    <th scope="row" class="ps-4 fw-normal text-muted">#{{ $semestre->id }}</th>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                <i class="bi bi-calendar-check text-primary"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold">{{ $semestre->descripcion }}</h6>
                                                <small class="text-muted">
                                                    Creado: {{ $semestre->created_at->format('d/m/Y') }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-success bg-opacity-10 text-success border-0 py-2">
                                            <i class="bi bi-check-circle me-1"></i>
                                            Activo
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="fw-bold text-primary">0</span>
                                        <small class="text-muted d-block">estudiantes</small>
                                    </td>
                                    <td class="text-center">
                                        <span class="fw-bold text-info">0</span>
                                        <small class="text-muted d-block">grupos</small>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('admin.semestres.edit', $semestre) }}" 
                                               class="btn btn-sm btn-outline-primary d-flex align-items-center"
                                               data-bs-toggle="tooltip" title="Editar semestre">
                                                <i class="bi bi-pencil-fill me-1"></i>
                                                Editar
                                            </a>
                                            
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-danger d-flex align-items-center"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteModal{{ $semestre->id }}"
                                                    data-bs-toggle="tooltip" title="Eliminar semestre">
                                                <i class="bi bi-trash-fill me-1"></i>
                                                Eliminar
                                            </button>
                                        </div>

                                        <!-- Modal de Confirmación de Eliminación -->
                                        <div class="modal fade" id="deleteModal{{ $semestre->id }}" tabindex="-1">
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
                                                        <p class="mb-3">¿Estás seguro de que deseas eliminar este semestre?</p>
                                                        <div class="alert alert-warning border-0 bg-warning bg-opacity-10">
                                                            <div class="d-flex align-items-center">
                                                                <i class="bi bi-calendar-range me-2"></i>
                                                                <div>
                                                                    <strong>{{ $semestre->descripcion }}</strong><br>
                                                                    <small class="text-muted">ID: #{{ $semestre->id }}</small>
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
                                                        <form action="{{ route('admin.semestres.destroy', $semestre) }}" method="POST" class="d-inline">
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
                        <i class="bi bi-calendar-x display-4 text-muted opacity-50"></i>
                        <h5 class="text-muted mt-3">No hay semestres registrados</h5>
                        <p class="text-muted mb-4">Comienza creando el primer semestre académico.</p>
                        <a href="{{ route('admin.semestres.create') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-plus-circle me-2"></i>
                            Crear Primer Semestre
                        </a>
                    </div>
                </div>
                @endif

                <!-- Paginación Mejorada -->
                @if ($semestres->hasPages())
                    <div class="card-footer bg-white border-0 py-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <p class="text-muted mb-0 small">
                                    Mostrando {{ $semestres->firstItem() }} - {{ $semestres->lastItem() }} de {{ $semestres->total() }} resultados
                                </p>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-md-end">
                                    {{ $semestres->links('pagination::bootstrap-5') }}
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
                        <h6 class="fw-bold">¿Qué son los semestres?</h6>
                        <p class="text-muted small mb-0">
                            Los semestres representan periodos académicos. Cada estudiante debe estar asignado a un semestre específico.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 bg-light shadow-sm">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-lightbulb display-4 text-warning opacity-50 mb-3"></i>
                        <h6 class="fw-bold">Buenas Prácticas</h6>
                        <p class="text-muted small mb-0">
                            Mantén solo los semestres activos. Archiva los semestres anteriores para mantener la base de datos organizada.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 bg-light shadow-sm">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-shield-check display-4 text-success opacity-50 mb-3"></i>
                        <h6 class="fw-bold">Seguridad de Datos</h6>
                        <p class="text-muted small mb-0">
                            No elimines semestres con estudiantes asignados. Esto podría afectar la integridad de los datos académicos.
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