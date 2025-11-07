<x-app-layout>
    <x-slot name="header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="h2 fw-bold text-dark mb-0" style="font-family: 'Georgia', serif;">
                        Editar Grupo
                    </h1>
                    <nav aria-label="breadcrumb" class="mt-2">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.grupos.index') }}" class="text-decoration-none">Grupos</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar {{ $grupo->nombre_grupo }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.grupos.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i>
                        Volver a la lista
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-white py-4 border-0">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="bi bi-collection text-primary fs-4"></i>
                            </div>
                            <div>
                                <h5 class="card-title fw-bold mb-1" style="font-family: 'Georgia', serif;">
                                    Actualizar Grupo Académico
                                </h5>
                                <p class="text-muted mb-0">Editando: {{ $grupo->nombre_grupo }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('admin.grupos.update', $grupo) }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')

                            <!-- Información del Grupo -->
                            <div class="mb-4">
                                <h6 class="fw-bold text-primary mb-3 d-flex align-items-center">
                                    <i class="bi bi-info-circle me-2"></i>
                                    Información del Grupo
                                </h6>
                                
                                <div class="mb-4">
                                    <label for="nombre_grupo" class="form-label fw-semibold">
                                        Nombre del Grupo <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="bi bi-tag text-muted"></i>
                                        </span>
                                        <input id="nombre_grupo" type="text" 
                                               class="form-control border-start-0 ps-0 @error('nombre_grupo') is-invalid @enderror" 
                                               name="nombre_grupo" 
                                               value="{{ old('nombre_grupo', $grupo->nombre_grupo) }}" 
                                               placeholder="Ej: ISC-702"
                                               required 
                                               autofocus>
                                    </div>
                                    <div class="form-text text-muted mt-2">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Usa un formato consistente como "CARRERA-SEMESTRE-SECCIÓN" para mejor organización.
                                    </div>
                                    @error('nombre_grupo')
                                        <div class="invalid-feedback d-block">
                                            <i class="bi bi-exclamation-circle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="turno" class="form-label fw-semibold">
                                        Turno <span class="text-danger">*</span>
                                    </label>
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <div class="form-check card border-0 bg-light hover-lift h-100">
                                                <input class="form-check-input d-none" type="radio" name="turno" 
                                                       id="turno_matutino" value="Matutino" 
                                                       {{ old('turno', $grupo->turno) == 'Matutino' ? 'checked' : '' }}>
                                                <label class="form-check-label card-body text-center p-3 w-100" for="turno_matutino">
                                                    <i class="bi bi-sun display-6 text-warning mb-2 d-block"></i>
                                                    <h6 class="fw-bold mb-1">Matutino</h6>
                                                    <small class="text-muted">7:00 AM - 1:00 PM</small>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check card border-0 bg-light hover-lift h-100">
                                                <input class="form-check-input d-none" type="radio" name="turno" 
                                                       id="turno_vespertino" value="Vespertino" 
                                                       {{ old('turno', $grupo->turno) == 'Vespertino' ? 'checked' : '' }}>
                                                <label class="form-check-label card-body text-center p-3 w-100" for="turno_vespertino">
                                                    <i class="bi bi-moon display-6 text-primary mb-2 d-block"></i>
                                                    <h6 class="fw-bold mb-1">Vespertino</h6>
                                                    <small class="text-muted">1:00 PM - 7:00 PM</small>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @error('turno')
                                        <div class="invalid-feedback d-block">
                                            <i class="bi bi-exclamation-circle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Ejemplos de Nomenclatura -->
                            <div class="alert alert-info border-0 bg-info bg-opacity-10">
                                <h6 class="fw-bold mb-2 d-flex align-items-center">
                                    <i class="bi bi-lightbulb text-info me-2"></i>
                                    Ejemplos de nomenclatura recomendada:
                                </h6>
                                <div class="row small text-muted">
                                    <div class="col-md-6">
                                        <i class="bi bi-check text-success me-1"></i> ISC-701 (Ing. Sistemas)<br>
                                        <i class="bi bi-check text-success me-1"></i> ING-402 (Ing. Industrial)
                                    </div>
                                    <div class="col-md-6">
                                        <i class="bi bi-check text-success me-1"></i> ADM-301 (Administración)<br>
                                        <i class="bi bi-check text-success me-1"></i> CON-201 (Contabilidad)
                                    </div>
                                </div>
                            </div>

                            <!-- Botones de Acción -->
                            <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                                <a href="{{ route('admin.grupos.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle me-1"></i>
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg px-4">
                                    <i class="bi bi-check-circle me-2"></i>
                                    Actualizar Grupo
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Información del Grupo -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-white py-3 border-0">
                        <h6 class="fw-bold mb-0 d-flex align-items-center">
                            <i class="bi bi-graph-up text-primary me-2"></i>
                            Estadísticas del Grupo
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="border-end">
                                    <h4 class="fw-bold text-primary mb-1">0</h4>
                                    <small class="text-muted">Estudiantes</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border-end">
                                    <h4 class="fw-bold text-info mb-1">0</h4>
                                    <small class="text-muted">Materias</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <h4 class="fw-bold text-success mb-1">{{ $grupo->created_at->format('d/m/Y') }}</h4>
                                <small class="text-muted">Creado</small>
                            </div>
                        </div>
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
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .form-check-input:checked + .card {
            border: 2px solid var(--bs-primary) !important;
            background-color: rgba(var(--bs-primary-rgb), 0.05) !important;
        }
    </style>

    <script>
        // Form validation
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.needs-validation')?.addEventListener('submit', function(event) {
                if (!this.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                this.classList.add('was-validated');
            }, false);
        });
    </script>
</x-app-layout>