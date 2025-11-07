<x-app-layout>
    <x-slot name="header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="h2 fw-bold text-dark mb-0" style="font-family: 'Georgia', serif;">
                        Crear Nueva Materia
                    </h1>
                    <nav aria-label="breadcrumb" class="mt-2">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.materias.index') }}" class="text-decoration-none">Materias</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Nueva Materia</li>
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
                            <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="bi bi-plus-circle text-success fs-4"></i>
                            </div>
                            <div>
                                <h5 class="card-title fw-bold mb-1" style="font-family: 'Georgia', serif;">
                                    Registrar Nueva Materia
                                </h5>
                                <p class="text-muted mb-0">Agrega una nueva asignatura al plan de estudios</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('admin.materias.store') }}" method="POST" class="needs-validation" novalidate>
                            @csrf

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
                                               value="{{ old('nombre_materia') }}" 
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
                                               value="{{ old('clave_materia') }}" 
                                               placeholder="Ej: SCB-1025">
                                    </div>
                                    <div class="form-text text-muted mt-2">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Usa un formato como "ABC-1234" donde ABC son siglas y 1234 el número identificador.
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
                                               value="{{ old('numero_unidades', 5) }}" 
                                               min="1" max="15" 
                                               required>
                                        <span class="input-group-text bg-light">unidades</span>
                                    </div>
                                    <div class="form-text text-muted mt-2">
                                        <i class="bi bi-info-circle me-1"></i>
                                        La mayoría de las materias tienen entre 3 y 10 unidades de aprendizaje.
                                    </div>
                                    @error('numero_unidades')
                                        <div class="invalid-feedback d-block">
                                            <i class="bi bi-exclamation-circle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Selector Rápido de Unidades -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Selección rápida de unidades:</label>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach([3, 4, 5, 6, 7, 8, 10] as $units)
                                        <button type="button" class="btn btn-outline-primary btn-unidades" data-units="{{ $units }}">
                                            {{ $units }} unidades
                                        </button>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Botones de Acción -->
                            <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                                <a href="{{ route('admin.materias.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle me-1"></i>
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-success btn-lg px-4">
                                    <i class="bi bi-plus-circle me-2"></i>
                                    Crear Materia
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
                            ¿Por qué son importantes las materias?
                        </h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled text-muted small mb-0">
                            <li class="mb-2">
                                <i class="bi bi-check text-success me-2"></i>
                                <strong>Estructura académica:</strong> Definen el plan de estudios y currículo
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check text-success me-2"></i>
                                <strong>Asignación docente:</strong> Permiten asignar profesores especializados
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check text-success me-2"></i>
                                <strong>Evaluación estudiantil:</strong> Facilitan el registro de calificaciones
                            </li>
                            <li>
                                <i class="bi bi-check text-success me-2"></i>
                                <strong>Organización curricular:</strong> Estructuran el avance académico por semestres
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .btn-unidades {
            transition: all 0.3s ease;
        }
        .btn-unidades:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .btn-unidades.active {
            background-color: var(--bs-primary);
            border-color: var(--bs-primary);
            color: white;
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

            // Selector rápido de unidades
            const unidadesInput = document.getElementById('numero_unidades');
            const unidadButtons = document.querySelectorAll('.btn-unidades');
            
            unidadButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const units = this.getAttribute('data-units');
                    unidadesInput.value = units;
                    
                    // Remover clase active de todos los botones
                    unidadButtons.forEach(btn => btn.classList.remove('active'));
                    // Agregar clase active al botón clickeado
                    this.classList.add('active');
                });
            });

            // Validación de número de unidades
            unidadesInput?.addEventListener('change', function() {
                const value = parseInt(this.value);
                if (value < 1) {
                    this.value = 1;
                } else if (value > 15) {
                    this.value = 15;
                }
                
                // Actualizar estado de botones
                unidadButtons.forEach(btn => {
                    if (parseInt(btn.getAttribute('data-units')) === parseInt(this.value)) {
                        btn.classList.add('active');
                    } else {
                        btn.classList.remove('active');
                    }
                });
            });

            // Inicializar estado de botones
            if (unidadesInput) {
                unidadesInput.dispatchEvent(new Event('change'));
            }
        });
    </script>
</x-app-layout>