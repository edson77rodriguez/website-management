<x-app-layout>
    <x-slot name="header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="h2 fw-bold text-dark mb-0" style="font-family: 'Georgia', serif;">
                        Editar Asignación
                    </h1>
                    <nav aria-label="breadcrumb" class="mt-2">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.asignaciones.index') }}" class="text-decoration-none">Asignaciones</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar Asignación #{{ $asignacion->id }}</li>
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
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="bi bi-link-45deg text-primary fs-4"></i>
                            </div>
                            <div>
                                <h5 class="card-title fw-bold mb-1" style="font-family: 'Georgia', serif;">
                                    Actualizar Asignación Académica
                                </h5>
                                <p class="text-muted mb-0">Modifica la relación entre docente, materia y grupo</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('admin.asignaciones.update', $asignacion) }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')

                            <!-- Información Actual -->
                            <div class="mb-4">
                                <h6 class="fw-bold text-primary mb-3 d-flex align-items-center">
                                    <i class="bi bi-info-circle me-2"></i>
                                    Asignación Actual
                                </h6>
                                <div class="alert alert-info border-0 bg-info bg-opacity-10">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-person-check text-success me-2"></i>
                                                <div>
                                                    <strong>Docente:</strong><br>
                                                    <small>{{ $asignacion->docente->user->nombre }} {{ $asignacion->docente->user->apellido_paterno }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-journal-text text-info me-2"></i>
                                                <div>
                                                    <strong>Materia:</strong><br>
                                                    <small>{{ $asignacion->materia->nombre_materia }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-collection text-warning me-2"></i>
                                                <div>
                                                    <strong>Grupo:</strong><br>
                                                    <small>{{ $asignacion->grupo->nombre_grupo }} ({{ $asignacion->grupo->turno }})</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Formulario de Edición -->
                            <div class="mb-4">
                                <h6 class="fw-bold text-primary mb-3 d-flex align-items-center">
                                    <i class="bi bi-pencil-square me-2"></i>
                                    Modificar Asignación
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
                                                @foreach ($grupos as $grupo)
                                                    <option value="{{ $grupo->id }}" 
                                                        {{ old('grupo_id', $asignacion->grupo_id) == $grupo->id ? 'selected' : '' }}>
                                                        {{ $grupo->nombre_grupo }} ({{ $grupo->turno }})
                                                    </option>
                                                @endforeach
                                            </select>
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
                                                @foreach ($materias as $materia)
                                                    <option value="{{ $materia->id }}" 
                                                        {{ old('materia_id', $asignacion->materia_id) == $materia->id ? 'selected' : '' }}>
                                                        {{ $materia->nombre_materia }}
                                                        @if($materia->clave_materia)
                                                            ({{ $materia->clave_materia }})
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
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
                                                @foreach ($docentes as $docente)
                                                    <option value="{{ $docente->id }}" 
                                                        {{ old('docente_id', $asignacion->docente_id) == $docente->id ? 'selected' : '' }}>
                                                        {{ $docente->user->nombre }} {{ $docente->user->apellido_paterno }}
                                                    </option>
                                                @endforeach
                                            </select>
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

                            <!-- Validación de Conflictos -->
                            <div class="alert alert-warning border-0 bg-warning bg-opacity-10">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-exclamation-triangle text-warning me-2 fs-5"></i>
                                    <div>
                                        <strong>Verificación de conflictos</strong><br>
                                        <small class="text-muted">
                                            El sistema verificará automáticamente si esta combinación ya existe 
                                            o si genera conflictos de horarios con otras asignaciones.
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Botones de Acción -->
                            <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                                <a href="{{ route('admin.asignaciones.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle me-1"></i>
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg px-4">
                                    <i class="bi bi-check-circle me-2"></i>
                                    Actualizar Asignación
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Información de la Asignación -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-white py-3 border-0">
                        <h6 class="fw-bold mb-0 d-flex align-items-center">
                            <i class="bi bi-graph-up text-primary me-2"></i>
                            Información de la Asignación
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="border-end">
                                    <h4 class="fw-bold text-primary mb-1">{{ $asignacion->materia->numero_unidades }}</h4>
                                    <small class="text-muted">Unidades</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border-end">
                                    <h4 class="fw-bold text-info mb-1">0</h4>
                                    <small class="text-muted">Estudiantes</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <h4 class="fw-bold text-success mb-1">{{ $asignacion->created_at->format('d/m/Y') }}</h4>
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
        });
    </script>
</x-app-layout>