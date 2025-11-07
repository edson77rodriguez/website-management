<x-app-layout>
    <x-slot name="header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="h2 fw-bold text-dark mb-0" style="font-family: 'Georgia', serif;">
                        Editar Semestre
                    </h1>
                    <nav aria-label="breadcrumb" class="mt-2">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.semestres.index') }}" class="text-decoration-none">Semestres</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar {{ $semestre->descripcion }}</li>
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
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="bi bi-calendar-range text-primary fs-4"></i>
                            </div>
                            <div>
                                <h5 class="card-title fw-bold mb-1" style="font-family: 'Georgia', serif;">
                                    Actualizar Semestre Académico
                                </h5>
                                <p class="text-muted mb-0">Editando: {{ $semestre->descripcion }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('admin.semestres.update', $semestre) }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')

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
                                               value="{{ old('descripcion', $semestre->descripcion) }}" 
                                               placeholder="Ej: Primer Semestre 2024"
                                               required 
                                               autofocus>
                                    </div>
                                    <div class="form-text text-muted mt-2">
                                        <i class="bi bi-info-circle me-1"></i>
                                        El nombre debe ser único y descriptivo para identificar el periodo académico.
                                    </div>
                                    @error('descripcion')
                                        <div class="invalid-feedback d-block">
                                            <i class="bi bi-exclamation-circle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Información Adicional -->
                            <div class="alert alert-info border-0 bg-info bg-opacity-10">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-lightbulb text-info me-2 fs-5"></i>
                                    <div>
                                        <strong>Consejo de organización</strong><br>
                                        <small class="text-muted">
                                            Usa nombres consistentes como "Primer Semestre 2024", "Segundo Semestre 2024" para mantener 
                                            una estructura académica clara y organizada.
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Botones de Acción -->
                            <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                                <a href="{{ route('admin.semestres.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle me-1"></i>
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg px-4">
                                    <i class="bi bi-check-circle me-2"></i>
                                    Actualizar Semestre
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Información del Semestre -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-white py-3 border-0">
                        <h6 class="fw-bold mb-0 d-flex align-items-center">
                            <i class="bi bi-graph-up text-primary me-2"></i>
                            Estadísticas del Semestre
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
                                    <small class="text-muted">Grupos</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <h4 class="fw-bold text-success mb-1">{{ $semestre->created_at->format('d/m/Y') }}</h4>
                                <small class="text-muted">Creado</small>
                            </div>
                        </div>
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
        });
    </script>
</x-app-layout>