<x-app-layout>
    <x-slot name="header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="h2 fw-bold text-dark mb-0" style="font-family: 'Georgia', serif;">
                        Crear Nueva Asignación
                    </h1>
                    <nav aria-label="breadcrumb" class="mt-2">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.asignaciones.index') }}" class="text-decoration-none">Asignaciones</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Nueva Asignación</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.asignaciones.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i>
                        Volver a la lista
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-white py-4 border-0">
                        <div class="d-flex align-items-center">
                            <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="bi bi-plus-circle text-success fs-4"></i>
                            </div>
                            <div>
                                <h5 class="card-title fw-bold mb-1" style="font-family: 'Georgia', serif;">
                                    Crear Nueva Asignación
                                </h5>
                                <p class="text-muted mb-0">Establece la relación entre docente, materia y grupo</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('admin.asignaciones.store') }}" method="POST" class="needs-validation" novalidate>
                            @csrf

                            <!-- Formulario de Creación -->
                            <div class="mb-4">
                                <h6 class="fw-bold text-primary mb-3 d-flex align-items-center">
                                    <i class="bi bi-pencil-square me-2"></i>
                                    Información de la Asignación
                                </h6>
                                
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label for="grupo_id" class="form-label fw-semibold">
                                            Grupo <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="bi bi-collection text-muted"></i>
                                            </span>
                                            <select id="grupo_id" name="grupo_id" 
                                                    class="form-select border-start-0 ps-0 @error('grupo_id') is-invalid @enderror" 
                                                    required>
                                                <option value="" disabled selected>Selecciona un grupo...</option>
                                                @foreach ($grupos as $grupo)
                                                    <option value="{{ $grupo->id }}" {{ old('grupo_id') == $grupo->id ? 'selected' : '' }}>
                                                        {{ $grupo->nombre_grupo }} ({{ $grupo->turno }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-text text-muted mt-2">
                                            <i class="bi bi-info-circle me-1"></i>
                                            Selecciona el grupo al que se asignará la materia.
                                        </div>
                                        @error('grupo_id')
                                            <div class="invalid-feedback d-block">
                                                <i class="bi bi-exclamation-circle me-1"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="materia_id" class="form-label fw-semibold">
                                            Materia <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="bi bi-journal-text text-muted"></i>
                                            </span>
                                            <select id="materia_id" name="materia_id" 
                                                    class="form-select border-start-0 ps-0 @error('materia_id') is-invalid @enderror" 
                                                    required>
                                                <option value="" disabled selected>Selecciona una materia...</option>
                                                @foreach ($materias as $materia)
                                                    <option value="{{ $materia->id }}" {{ old('materia_id') == $materia->id ? 'selected' : '' }}>
                                                        {{ $materia->nombre_materia }}
                                                        @if($materia->clave_materia)
                                                            ({{ $materia->clave_materia }})
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-text text-muted mt-2">
                                            <i class="bi bi-info-circle me-1"></i>
                                            Elige la materia que se impartirá en este grupo.
                                        </div>
                                        @error('materia_id')
                                            <div class="invalid-feedback d-block">
                                                <i class="bi bi-exclamation-circle me-1"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="docente_id" class="form-label fw-semibold">
                                            Docente <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="bi bi-person-check text-muted"></i>
                                            </span>
                                            <select id="docente_id" name="docente_id" 
                                                    class="form-select border-start-0 ps-0 @error('docente_id') is-invalid @enderror" 
                                                    required>
                                                <option value="" disabled selected>Selecciona un docente...</option>
                                                @foreach ($docentes as $docente)
                                                    <option value="{{ $docente->id }}" {{ old('docente_id') == $docente->id ? 'selected' : '' }}>
                                                        {{ $docente->user->nombre }} {{ $docente->user->apellido_paterno }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-text text-muted mt-2">
                                            <i class="bi bi-info-circle me-1"></i>
                                            Asigna el docente que impartirá esta materia.
                                        </div>
                                        @error('docente_id')
                                            <div class="invalid-feedback d-block">
                                                <i class="bi bi-exclamation-circle me-1"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Visualización de la Relación -->
                            <div class="mb-4">
                                <h6 class="fw-bold text-primary mb-3 d-flex align-items-center">
                                    <i class="bi bi-eye me-2"></i>
                                    Vista Previa de la Asignación
                                </h6>
                                <div class="card border-0 bg-light">
                                    <div class="card-body text-center p-4">
                                        <div class="row align-items-center">
                                            <div class="col-md-4">
                                                <div class="bg-success bg-opacity-10 rounded-circle p-3 d-inline-flex mb-2">
                                                    <i class="bi bi-person-check text-success fs-2"></i>
                                                </div>
                                                <h6 class="fw-bold mb-1">Docente</h6>
                                                <small class="text-muted" id="preview-docente">Selecciona un docente</small>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-flex mb-2">
                                                    <i class="bi bi-arrow-left-right text-primary fs-2"></i>
                                                </div>
                                                <h6 class="fw-bold mb-1">Impartirá</h6>
                                                <small class="text-muted">la materia</small>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="bg-info bg-opacity-10 rounded-circle p-3 d-inline-flex mb-2">
                                                    <i class="bi bi-journal-text text-info fs-2"></i>
                                                </div>
                                                <h6 class="fw-bold mb-1">Materia</h6>
                                                <small class="text-muted" id="preview-materia">Selecciona una materia</small>
                                            </div>
                                        </div>
                                        <div class="mt-3 pt-3 border-top">
                                            <div class="bg-warning bg-opacity-10 rounded-circle p-2 d-inline-flex mb-2">
                                                <i class="bi bi-arrow-down text-warning"></i>
                                            </div>
                                            <h6 class="fw-bold mb-1">Al Grupo</h6>
                                            <small class="text-muted" id="preview-grupo">Selecciona un grupo</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Botones de Acción -->
                            <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                                <a href="{{ route('admin.asignaciones.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle me-1"></i>
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-success btn-lg px-4">
                                    <i class="bi bi-plus-circle me-2"></i>
                                    Crear Asignación
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
                            ¿Por qué son importantes las asignaciones?
                        </h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled text-muted small mb-0">
                            <li class="mb-2">
                                <i class="bi bi-check text-success me-2"></i>
                                <strong>Organización académica:</strong> Estructuran la distribución de materias
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check text-success me-2"></i>
                                <strong>Control de carga docente:</strong> Permiten balancear la carga de trabajo
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check text-success me-2"></i>
                                <strong>Registro de calificaciones:</strong> Facilitan el seguimiento académico
                            </li>
                            <li>
                                <i class="bi bi-check text-success me-2"></i>
                                <strong>Planificación horaria:</strong> Ayudan en la creación de horarios
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

            // Vista previa en tiempo real
            const grupoSelect = document.getElementById('grupo_id');
            const materiaSelect = document.getElementById('materia_id');
            const docenteSelect = document.getElementById('docente_id');

            function updatePreview() {
                const grupoText = grupoSelect.options[grupoSelect.selectedIndex]?.text || 'Selecciona un grupo';
                const materiaText = materiaSelect.options[materiaSelect.selectedIndex]?.text || 'Selecciona una materia';
                const docenteText = docenteSelect.options[docenteSelect.selectedIndex]?.text || 'Selecciona un docente';

                document.getElementById('preview-grupo').textContent = grupoText;
                document.getElementById('preview-materia').textContent = materiaText.split(' (')[0]; // Remover clave si existe
                document.getElementById('preview-docente').textContent = docenteText;
            }

            grupoSelect?.addEventListener('change', updatePreview);
            materiaSelect?.addEventListener('change', updatePreview);
            docenteSelect?.addEventListener('change', updatePreview);

            // Inicializar vista previa
            updatePreview();
        });
    </script>
</x-app-layout>