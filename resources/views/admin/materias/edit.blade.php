<x-app-layout>
    <x-slot name="header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="h2 fw-bold text-dark mb-0" style="font-family: 'Georgia', serif;">
                        Editar Materia
                    </h1>
                    <nav aria-label="breadcrumb" class="mt-2">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.materias.index') }}" class="text-decoration-none">Materias</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar {{ $materia->nombre_materia }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.materias.index') }}" class="btn btn-outline-secondary">
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
                                <i class="bi bi-journal-text text-primary fs-4"></i>
                            </div>
                            <div>
                                <h5 class="card-title fw-bold mb-1" style="font-family: 'Georgia', serif;">
                                    Actualizar Materia Académica
                                </h5>
                                <p class="text-muted mb-0">Editando: {{ $materia->nombre_materia }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('admin.materias.update', $materia) }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')

                            <!-- Información de la Materia -->
                            <div class="mb-4">
                                <h6 class="fw-bold text-primary mb-3 d-flex align-items-center">
                                    <i class="bi bi-info-circle me-2"></i>
                                    Información de la Materia
                                </h6>
                                
                                <div class="mb-4">
                                    <label for="nombre_materia" class="form-label fw-semibold">
                                        Nombre de la Materia <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="bi bi-journal-text text-muted"></i>
                                        </span>
                                        <input id="nombre_materia" type="text" 
                                               class="form-control border-start-0 ps-0 @error('nombre_materia') is-invalid @enderror" 
                                               name="nombre_materia" 
                                               value="{{ old('nombre_materia', $materia->nombre_materia) }}" 
                                               placeholder="Ej: Taller de Investigación II"
                                               required 
                                               autofocus>
                                    </div>
                                    <div class="form-text text-muted mt-2">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Usa nombres completos y descriptivos para identificar claramente la materia.
                                    </div>
                                    @error('nombre_materia')
                                        <div class="invalid-feedback d-block">
                                            <i class="bi bi-exclamation-circle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="clave_materia" class="form-label fw-semibold">
                                        Clave de la Materia 
                                        <span class="text-muted fw-normal">(Opcional)</span>
                                    </label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="bi bi-key text-muted"></i>
                                        </span>
                                        <input id="clave_materia" type="text" 
                                               class="form-control border-start-0 ps-0 @error('clave_materia') is-invalid @enderror" 
                                               name="clave_materia" 
                                               value="{{ old('clave_materia', $materia->clave_materia) }}" 
                                               placeholder="Ej: SCB-1025">
                                    </div>
                                    <div class="form-text text-muted mt-2">
                                        <i class="bi bi-info-circle me-1"></i>
                                        La clave ayuda a identificar rápidamente la materia en reportes y asignaciones.
                                    </div>
                                    @error('clave_materia')
                                        <div class="invalid-feedback d-block">
                                            <i class="bi bi-exclamation-circle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="numero_unidades" class="form-label fw-semibold">
                                        Número de Unidades <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="bi bi-layer-forward text-muted"></i>
                                        </span>
                                        <input id="numero_unidades" type="number" 
                                               class="form-control border-start-0 ps-0 @error('numero_unidades') is-invalid @enderror" 
                                               name="numero_unidades" 
                                               value="{{ old('numero_unidades', $materia->numero_unidades) }}" 
                                               min="1" max="15" 
                                               required>
                                        <span class="input-group-text bg-light">unidades</span>
                                    </div>
                                    <div class="form-text text-muted mt-2">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Define cuántas unidades de aprendizaje tendrá esta materia. Lo común es entre 3 y 10 unidades.
                                    </div>
                                    @error('numero_unidades')
                                        <div class="invalid-feedback d-block">
                                            <i class="bi bi-exclamation-circle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Guía de Unidades -->
                            <div class="alert alert-info border-0 bg-info bg-opacity-10">
                                <h6 class="fw-bold mb-2 d-flex align-items-center">
                                    <i class="bi bi-lightbulb text-info me-2"></i>
                                    Recomendaciones de unidades:
                                </h6>
                                <div class="row small text-muted">
                                    <div class="col-md-6">
                                        <i class="bi bi-check text-success me-1"></i> <strong>3-5 unidades:</strong> Materias básicas<br>
                                        <i class="bi bi-check text-success me-1"></i> <strong>5-7 unidades:</strong> Materias regulares
                                    </div>
                                    <div class="col-md-6">
                                        <i class="bi bi-check text-success me-1"></i> <strong>7-10 unidades:</strong> Materias avanzadas<br>
                                        <i class="bi bi-check text-success me-1"></i> <strong>10+ unidades:</strong> Proyectos/Tesis
                                    </div>
                                </div>
                            </div>

                            <!-- Botones de Acción -->
                            <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                                <a href="{{ route('admin.materias.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle me-1"></i>
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg px-4">
                                    <i class="bi bi-check-circle me-2"></i>
                                    Actualizar Materia
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Información de la Materia -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-white py-3 border-0">
                        <h6 class="fw-bold mb-0 d-flex align-items-center">
                            <i class="bi bi-graph-up text-primary me-2"></i>
                            Estadísticas de la Materia
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="border-end">
                                    <h4 class="fw-bold text-primary mb-1">{{ $materia->numero_unidades }}</h4>
                                    <small class="text-muted">Unidades</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border-end">
                                    <h4 class="fw-bold text-info mb-1">0</h4>
                                    <small class="text-muted">Grupos</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <h4 class="fw-bold text-success mb-1">{{ $materia->created_at->format('d/m/Y') }}</h4>
                                <small class="text-muted">Creada</small>
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

            // Validación de número de unidades
            const unidadesInput = document.getElementById('numero_unidades');
            unidadesInput?.addEventListener('change', function() {
                const value = parseInt(this.value);
                if (value < 1) {
                    this.value = 1;
                } else if (value > 15) {
                    this.value = 15;
                }
            });
        });
    </script>
</x-app-layout>