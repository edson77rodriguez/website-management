<x-app-layout>
    <x-slot name="header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="h2 fw-bold text-dark mb-0" style="font-family: 'Georgia', serif;">
                        Crear Nuevo Semestre
                    </h1>
                    <nav aria-label="breadcrumb" class="mt-2">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.semestres.index') }}" class="text-decoration-none">Semestres</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Nuevo Semestre</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.semestres.index') }}" class="btn btn-outline-secondary">
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
                                    Registrar Nuevo Semestre
                                </h5>
                                <p class="text-muted mb-0">Crea un nuevo periodo académico para organizar a los estudiantes</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('admin.semestres.store') }}" method="POST" class="needs-validation" novalidate>
                            @csrf

                            <!-- Información del Semestre -->
                            <div class="mb-4">
                                <h6 class="fw-bold text-primary mb-3 d-flex align-items-center">
                                    <i class="bi bi-info-circle me-2"></i>
                                    Información del Semestre
                                </h6>
                                
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label fw-semibold">
                                        Descripción del Semestre <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="bi bi-calendar-range text-muted"></i>
                                        </span>
                                        <input id="descripcion" type="text" 
                                               class="form-control border-start-0 ps-0 @error('descripcion') is-invalid @enderror" 
                                               name="descripcion" 
                                               value="{{ old('descripcion') }}" 
                                               placeholder="Ej: Primer Semestre 2024"
                                               required 
                                               autofocus>
                                    </div>
                                    <div class="form-text text-muted mt-2">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Usa un formato consistente: "[Número] Semestre [Año]" para mejor organización.
                                    </div>
                                    @error('descripcion')
                                        <div class="invalid-feedback d-block">
                                            <i class="bi bi-exclamation-circle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Ejemplos de Nomenclatura -->
                            <div class="alert alert-warning border-0 bg-warning bg-opacity-10">
                                <h6 class="fw-bold mb-2 d-flex align-items-center">
                                    <i class="bi bi-lightbulb text-warning me-2"></i>
                                    Ejemplos recomendados:
                                </h6>
                                <div class="row small text-muted">
                                    <div class="col-md-6">
                                        <i class="bi bi-check text-success me-1"></i> Primer Semestre 2024<br>
                                        <i class="bi bi-check text-success me-1"></i> Segundo Semestre 2024
                                    </div>
                                    <div class="col-md-6">
                                        <i class="bi bi-check text-success me-1"></i> Tercer Semestre 2024<br>
                                        <i class="bi bi-check text-success me-1"></i> Cuarto Semestre 2024
                                    </div>
                                </div>
                            </div>

                            <!-- Botones de Acción -->
                            <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                                <a href="{{ route('admin.semestres.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle me-1"></i>
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-success btn-lg px-4">
                                    <i class="bi bi-plus-circle me-2"></i>
                                    Crear Semestre
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
                            ¿Por qué son importantes los semestres?
                        </h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled text-muted small mb-0">
                            <li class="mb-2">
                                <i class="bi bi-check text-success me-2"></i>
                                <strong>Organización académica:</strong> Estructuran el progreso de los estudiantes
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check text-success me-2"></i>
                                <strong>Asignación de grupos:</strong> Permiten agrupar estudiantes por nivel
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check text-success me-2"></i>
                                <strong>Reportes académicos:</strong> Facilitan el análisis del rendimiento por periodo
                            </li>
                            <li>
                                <i class="bi bi-check text-success me-2"></i>
                                <strong>Planificación curricular:</strong> Ayudan en la organización del plan de estudios
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

            // Auto-sugerir año actual
            const descripcionInput = document.getElementById('descripcion');
            const currentYear = new Date().getFullYear();
            
            descripcionInput?.addEventListener('focus', function() {
                if (!this.value) {
                    this.placeholder = `Ej: Primer Semestre ${currentYear}`;
                }
            });
        });
    </script>
</x-app-layout>