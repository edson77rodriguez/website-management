<x-app-layout>
    <x-slot name="header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="h2 fw-bold text-dark mb-0" style="font-family: 'Georgia', serif;">
                        Gestión de Usuarios
                    </h1>
                    <nav aria-label="breadcrumb" class="mt-2">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.usuarios.create') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-person-plus me-2"></i>
                        Crear Usuario
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

        <!-- Card Principal -->
        <div class="card border-0 shadow-lg">
            <div class="card-header bg-white py-4 border-0">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h5 class="card-title fw-bold mb-0" style="font-family: 'Georgia', serif;">
                            <i class="bi bi-people-fill text-primary me-2"></i>
                            Lista de Usuarios
                        </h5>
                        <p class="text-muted mb-0 mt-1 small">Total: {{ $users->total() }} usuarios registrados</p>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-2 justify-content-md-end">
                            <!-- Botón Crear Usuario (nuevo) -->
                            <a href="{{ route('admin.usuarios.create') }}" class="btn btn-primary d-flex align-items-center">
                                <i class="bi bi-person-plus me-2"></i>
                                Crear Usuario
                            </a>

                            <!-- Filtros Rápidos -->
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-funnel me-1"></i>
                                    Filtrar por Rol
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['rol' => '']) }}">Todos los roles</a></li>
                                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['rol' => 'Administrador']) }}">Administradores</a></li>
                                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['rol' => 'Docente']) }}">Docentes</a></li>
                                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['rol' => 'Estudiante']) }}">Estudiantes</a></li>
                                </ul>
                            </div>
                            
                            <!-- Búsqueda -->
                            <form method="GET" class="d-flex">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Buscar usuario..." 
                                           value="{{ request('search') }}">
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
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="ps-4">#</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Contacto</th>
                                <th scope="col">Rol</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="text-end pe-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="hover-shadow">
                                    <th scope="row" class="ps-4 fw-normal text-muted">#{{ $user->id }}</th>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                <i class="bi bi-person-fill text-primary"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold">{{ $user->nombre }} {{ $user->apellido_paterno }}</h6>
                                                <small class="text-muted">
                                                    {{ $user->apellido_materno ? $user->apellido_materno : 'Sin apellido materno' }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-medium">{{ $user->email }}</span>
                                            <small class="text-muted">
                                                <i class="bi bi-calendar me-1"></i>
                                                {{ $user->created_at->format('d/m/Y') }}
                                            </small>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($user->rol == 'Administrador')
                                            <span class="badge bg-primary bg-opacity-10 text-primary border-0 py-2 px-3">
                                                <i class="bi bi-shield-check me-1"></i>
                                                {{ $user->rol }}
                                            </span>
                                        @elseif ($user->rol == 'Docente')
                                            <span class="badge bg-success bg-opacity-10 text-success border-0 py-2 px-3">
                                                <i class="bi bi-person-video3 me-1"></i>
                                                {{ $user->rol }}
                                            </span>
                                        @else
                                            <span class="badge bg-info bg-opacity-10 text-info border-0 py-2 px-3">
                                                <i class="bi bi-mortarboard me-1"></i>
                                                {{ $user->rol }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-success bg-opacity-10 text-success border-0">
                                            <i class="bi bi-check-circle me-1"></i>
                                            Activo
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('admin.usuarios.edit', $user) }}" 
                                               class="btn btn-sm btn-outline-primary d-flex align-items-center"
                                               data-bs-toggle="tooltip" title="Editar usuario">
                                                <i class="bi bi-pencil-fill me-1"></i>
                                                Editar
                                            </a>
                                            
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-danger d-flex align-items-center"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteModal{{ $user->id }}"
                                                    data-bs-toggle="tooltip" title="Eliminar usuario">
                                                <i class="bi bi-trash-fill me-1"></i>
                                                Eliminar
                                            </button>
                                        </div>

                                        <!-- Modal de Confirmación de Eliminación -->
                                        <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1">
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
                                                        <p class="mb-3">¿Estás seguro de que deseas eliminar al usuario?</p>
                                                        <div class="alert alert-warning border-0 bg-warning bg-opacity-10">
                                                            <div class="d-flex align-items-center">
                                                                <i class="bi bi-person-fill me-2"></i>
                                                                <div>
                                                                    <strong>{{ $user->nombre }} {{ $user->apellido_paterno }}</strong><br>
                                                                    <small class="text-muted">{{ $user->email }} • {{ $user->rol }}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p class="text-danger small mb-0">
                                                            <i class="bi bi-info-circle me-1"></i>
                                                            Esta acción no se puede deshacer y se perderán todos los datos asociados.
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer border-0">
                                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                            Cancelar
                                                        </button>
                                                        <form action="{{ route('admin.usuarios.destroy', $user) }}" method="POST" class="d-inline">
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
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="py-4">
                                            <i class="bi bi-people display-4 text-muted opacity-50"></i>
                                            <h5 class="text-muted mt-3">No hay usuarios registrados</h5>
                                            <p class="text-muted mb-4">Comienza agregando el primer usuario al sistema.</p>
                                            <a href="{{ route('admin.usuarios.create') }}" class="btn btn-primary">
                                                <i class="bi bi-person-plus me-2"></i>
                                                Crear Primer Usuario
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginación Mejorada -->
                @if ($users->hasPages())
                    <div class="card-footer bg-white border-0 py-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <p class="text-muted mb-0 small">
                                    Mostrando {{ $users->firstItem() }} - {{ $users->lastItem() }} de {{ $users->total() }} resultados
                                </p>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-md-end">
                                    {{ $users->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .hover-shadow:hover {
            box-shadow: inset 0 0 0 1px var(--bs-primary), 0 2px 8px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        .table > :not(caption) > * > * {
            padding: 1rem 0.5rem;
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