<x-app-layout>
    <x-slot name="header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="h2 fw-bold text-dark mb-0" style="font-family: 'Georgia', serif;">
                        Crear Nuevo Grupo
                    </h1>
                    <nav aria-label="breadcrumb" class="mt-2">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.grupos.index') }}" class="text-decoration-none">Grupos</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Nuevo Grupo</li>
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
                            <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="bi bi-plus-circle text-success fs-4"></i>
                            </div>
                            <div>
                                <h5 class="card-title fw-bold mb-1" style="font-family: 'Georgia', serif;">
                                    Registrar Nuevo Grupo
                                </h5>
                                <p class="text-muted mb-0">Crea un nuevo grupo para organizar a los estudiantes</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('admin.grupos.store') }}" method="POST" class="needs-validation" novalidate>
                            @csrf

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
                                               value="{{ old('nombre_grupo') }}" 
                                               placeholder="Ej: ISC-702"
                                               required 
                                               autofocus>
                                    </div>
                                    <div class="form-text text-muted mt-2">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Usa el formato: Siglas de carrera + guión + semestre + sección
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
                                                       {{ old('turno') == 'Matutino' ? 'checked' : '' }}>
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
                                                       {{ old('turno') == 'Vespertino' ? 'checked' : '' }}>
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

                            <!-- Guía de Nomenclatura -->
                            <div class="alert alert-warning border-0 bg-warning bg-opacity-10">
                                <h6 class="fw-bold mb-2 d-flex align-items-center">
                                    <i class="bi bi-lightbulb text-warning me-2"></i>
                                    Guía de nomenclatura:
                                </h6>
                                <div class="row small text-muted">
                                    <div class="col-12 mb-2">
                                        <strong>Formato recomendado:</strong> [CARRERA]-[SEMESTRE][SECCIÓN]
                                    </div>
                                    <div class="col-md-6">
                                        <i class="bi bi-arrow-right me-1"></i> ISC → Ing. Sistemas<br>
                                        <i class="bi bi-arrow-right me-1"></i> ING → Ing. Industrial<br>
                                        <i class="bi bi-arrow-right me-1"></i> ADM → Administración
                                    </div>
                                    <div class="col-md-6">
                                        <i class="bi bi-arrow-right me-1"></i> CON → Contabilidad<br>
                                        <i class="bi bi-arrow-right me-1"></i> ARQ → Arquitectura<br>
                                        <i class="bi bi-arrow-right me-1"></i> MED → Medicina
                                    </div>
                                </div>
                            </div>

                            <!-- Botones de Acción -->
                            <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                                <a href="{{ route('admin.grupos.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle me-1"></i>
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-success btn-lg px-4">
                                    <i class="bi bi-plus-circle me-2"></i>
                                    Crear Grupo
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Información de Contexto -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-white py-3 border-0">
                        <h6 class="fw-bold mb-0 d-flex align-items-center">
                            <i class="bi bi-question-circle text-primary me-2"></i>
                            ¿Por qué son importantes los grupos?
                        </h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled text-muted small mb-0">
                            <li class="mb-2">
                                <i class="bi bi-check text-success me-2"></i>
                                <strong>Organización estudiantil:</strong> Agrupan estudiantes por nivel y turno
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check text-success me-2"></i>
                                <strong>Asignación de materias:</strong> Permiten asignar materias específicas por grupo
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check text-success me-2"></i>
                                <strong>Control de asistencia:</strong> Facilitan el registro de asistencia por grupo
                            </li>
                            <li>
                                <i class="bi bi-check text-success me-2"></i>
                                <strong>Reportes académicos:</strong> Generan reportes específicos por grupo
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

            // Auto-seleccionar primer turno si ninguno está seleccionado
            const turnoRadios = document.querySelectorAll('input[name="turno"]');
            if (!document.querySelector('input[name="turno"]:checked')) {
                document.getElementById('turno_matutino').checked = true;
            }
        });
    </script>
</x-app-layout>