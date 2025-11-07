<x-app-layout>
    <x-slot name="header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="h2 fw-bold text-dark mb-0" style="font-family: 'Georgia', serif;">
                        Registrar Calificaciones
                    </h1>
                    <nav aria-label="breadcrumb" class="mt-2">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('docente.asistencia.index') }}" class="text-decoration-none">Mis Clases</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Calificaciones</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto">
                    <a href="{{ route('docente.asistencia.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i>
                        Volver a mis clases
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="container-fluid">
        <!-- Información de la Materia -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 bg-gradient-info text-white shadow-lg">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h3 class="fw-bold mb-2" style="font-family: 'Georgia', serif;">
                                    {{ $asignacion->materia->nombre_materia }}
                                </h3>
                                <div class="row g-3">
                                    <div class="col-auto">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-collection me-2 opacity-75"></i>
                                            <div>
                                                <small class="opacity-75">Grupo</small>
                                                <div class="fw-bold">{{ $asignacion->grupo->nombre_grupo }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-layer-forward me-2 opacity-75"></i>
                                            <div>
                                                <small class="opacity-75">Unidades</small>
                                                <div class="fw-bold">{{ $unidades }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-people me-2 opacity-75"></i>
                                            <div>
                                                <small class="opacity-75">Estudiantes</small>
                                                <div class="fw-bold">{{ $estudiantes->count() }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-clock me-2 opacity-75"></i>
                                            <div>
                                                <small class="opacity-75">Turno</small>
                                                <div class="fw-bold">{{ $asignacion->grupo->turno }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-center text-md-end">
                                <div class="bg-white bg-opacity-20 rounded-circle p-4 d-inline-flex">
                                    <i class="bi bi-pencil-square display-4 opacity-75"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Controles y Estadísticas -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-primary bg-opacity-10 shadow-sm">
                    <div class="card-body text-center p-3">
                        <h4 class="fw-bold text-primary mb-1" id="promedio-grupo">0.0</h4>
                        <small class="text-muted">Promedio del Grupo</small>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-success bg-opacity-10 shadow-sm">
                    <div class="card-body text-center p-3">
                        <h4 class="fw-bold text-success mb-1" id="estudiantes-aprobados">0</h4>
                        <small class="text-muted">Estudiantes Aprobados</small>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-warning bg-opacity-10 shadow-sm">
                    <div class="card-body text-center p-3">
                        <h4 class="fw-bold text-warning mb-1" id="unidades-completas">0</h4>
                        <small class="text-muted">Unidades Completadas</small>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-info bg-opacity-10 shadow-sm">
                    <div class="card-body text-center p-3">
                        <h4 class="fw-bold text-info mb-1">{{ $estudiantes->count() }}</h4>
                        <small class="text-muted">Total Estudiantes</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Controles de Acción Rápida -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body py-3">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h6 class="fw-bold mb-0 d-flex align-items-center">
                                    <i class="bi bi-lightning-fill text-warning me-2"></i>
                                    Acciones Rápidas
                                </h6>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-wrap gap-2 justify-content-md-end">
                                    <button type="button" class="btn btn-outline-success btn-sm" id="marcar-aprobados">
                                        <i class="bi bi-check-all me-1"></i> Aprobar Todos (70+)
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm" id="limpiar-todas">
                                        <i class="bi bi-arrow-clockwise me-1"></i> Limpiar Todo
                                    </button>
                                    <div class="dropdown">
                                        <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-download me-1"></i> Exportar
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Excel</a></li>
                                            <li><a class="dropdown-item" href="#">PDF</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulario de Calificaciones -->
        <div class="row justify-content-center">
            <div class="col-12">
                <form action="{{ route('docente.calificaciones.store', $asignacion) }}" method="POST" id="calificaciones-form">
                    @csrf
                    
                    <div class="card border-0 shadow-lg">
                        <div class="card-header bg-white py-4 border-0">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h5 class="card-title fw-bold mb-0" style="font-family: 'Georgia', serif;">
                                        <i class="bi bi-list-check text-primary me-2"></i>
                                        Registro de Calificaciones
                                    </h5>
                                    <p class="text-muted mb-0 mt-1 small">
                                        Ingresa calificaciones (0-100) para cada unidad
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex gap-2 justify-content-md-end">
                                        <!-- Filtro de Unidades -->
                                        <div class="dropdown">
                                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                <i class="bi bi-funnel me-1"></i>
                                                Unidad Actual
                                            </button>
                                            <ul class="dropdown-menu">
                                                @for ($i = 1; $i <= $unidades; $i++)
                                                    <li><a class="dropdown-item unidad-filter" href="#" data-unidad="{{ $i }}">Unidad {{ $i }}</a></li>
                                                @endfor
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item unidad-filter" href="#" data-unidad="all">Todas las Unidades</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            @if($estudiantes->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0" id="calificaciones-table">
                                    <thead class="table-light sticky-top">
                                        <tr>
                                            <th scope="col" class="ps-4 sticky-column" style="min-width: 280px; background: white;">
                                                <div class="d-flex align-items-center">
                                                    <span>Estudiante</span>
                                                    <div class="ms-2">
                                                        <input type="text" class="form-control form-control-sm" id="buscar-estudiante" placeholder="Buscar...">
                                                    </div>
                                                </div>
                                            </th>
                                            
                                            @for ($i = 1; $i <= $unidades; $i++)
                                                <th scope="col" class="text-center unidad-header" data-unidad="{{ $i }}">
                                                    <div class="d-flex flex-column align-items-center">
                                                        <span class="fw-bold">U{{ $i }}</span>
                                                        <small class="text-muted">Unidad {{ $i }}</small>
                                                    </div>
                                                </th>
                                            @endfor

                                            <th scope="col" class="text-center sticky-column" style="min-width: 120px; background: white;">
                                                <div class="d-flex flex-column align-items-center">
                                                    <span class="fw-bold text-primary">Promedio</span>
                                                    <small class="text-muted">Final</small>
                                                </div>
                                            </th>
                                            
                                            <th scope="col" class="text-center sticky-column" style="min-width: 100px; background: white;">
                                                <div class="d-flex flex-column align-items-center">
                                                    <span class="fw-bold">Estado</span>
                                                    <small class="text-muted">Actual</small>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($estudiantes as $estudiante)
                                            <tr class="estudiante-row" data-nombre="{{ strtolower($estudiante->user->nombre . ' ' . $estudiante->user->apellido_paterno) }}">
                                                <!-- Columna Estudiante (Sticky) -->
                                                <td class="ps-4 sticky-column" style="background: white;">
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                            <i class="bi bi-person text-primary"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0 fw-bold">
                                                                {{ $estudiante->user->apellido_paterno }} 
                                                                {{ $estudiante->user->apellido_materno }}, 
                                                            </h6>
                                                            <div class="text-muted small">
                                                                {{ $estudiante->user->nombre }}
                                                                @if($estudiante->matricula)
                                                                    <br>
                                                                    <span class="text-info">Mat: {{ $estudiante->matricula }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <!-- Unidades -->
                                                @for ($i = 1; $i <= $unidades; $i++)
                                                    @php
                                                        $notaActual = $calificaciones[$estudiante->id][$i] ?? null;
                                                        $notaClass = $notaActual ? ($notaActual >= 70 ? 'border-success' : ($notaActual >= 60 ? 'border-warning' : 'border-danger')) : '';
                                                    @endphp
                                                    <td class="text-center unidad-cell" data-unidad="{{ $i }}">
                                                        <input type="number" 
                                                               class="form-control calificacion-input {{ $notaClass }} @error('calificaciones.'.$estudiante->id.'.'.$i) is-invalid @enderror"
                                                               name="calificaciones[{{ $estudiante->id }}][{{ $i }}]" 
                                                               value="{{ old('calificaciones.'.$estudiante->id.'.'.$i, $notaActual) }}"
                                                               data-estudiante-id="{{ $estudiante->id }}"
                                                               data-unidad="{{ $i }}"
                                                               step="0.1" min="0" max="100"
                                                               placeholder="0.0">
                                                        @error('calificaciones.'.$estudiante->id.'.'.$i)
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </td>
                                                @endfor

                                                <!-- Promedio (Sticky) -->
                                                <td class="text-center sticky-column" style="background: white;">
                                                    <span class="fw-bold fs-5 promedio-estudiante" data-estudiante-id="{{ $estudiante->id }}">
                                                        0.0
                                                    </span>
                                                </td>

                                                <!-- Estado (Sticky) -->
                                                <td class="text-center sticky-column" style="background: white;">
                                                    <span class="badge estado-estudiante" data-estudiante-id="{{ $estudiante->id }}">
                                                        Sin datos
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <!-- Estado Vacío -->
                            <div class="text-center py-5">
                                <i class="bi bi-people display-4 text-muted opacity-50"></i>
                                <h5 class="text-muted mt-3">No hay estudiantes inscritos</h5>
                                <p class="text-muted mb-0">No hay estudiantes asignados a este grupo.</p>
                            </div>
                            @endif
                        </div>

                        @if($estudiantes->count() > 0)
                        <div class="card-footer bg-white border-0 py-4">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle p-2 me-3">
                                            <i class="bi bi-graph-up text-primary"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Resumen del grupo</small>
                                            <small class="fw-bold">
                                                <span class="text-success" id="resumen-aprobados">0</span> aprobados • 
                                                <span class="text-warning" id="resumen-regulares">0</span> regulares • 
                                                <span class="text-danger" id="resumen-reprobados">0</span> reprobados
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex gap-2 justify-content-md-end">
                                        <a href="{{ route('docente.asistencia.index') }}" class="btn btn-outline-secondary">
                                            <i class="bi bi-x-circle me-1"></i>
                                            Cancelar
                                        </a>
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="bi bi-save-fill me-2"></i>
                                            Guardar Calificaciones
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Información Adicional -->
        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="card border-0 bg-light shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold d-flex align-items-center mb-3">
                            <i class="bi bi-info-circle text-primary me-2"></i>
                            Escala de Calificaciones
                        </h6>
                        <div class="row text-center small">
                            <div class="col-4">
                                <div class="border-end">
                                    <span class="badge bg-success mb-1">90-100</span>
                                    <div class="text-muted">Excelente</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border-end">
                                    <span class="badge bg-info mb-1">80-89</span>
                                    <div class="text-muted">Bueno</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <span class="badge bg-warning mb-1">70-79</span>
                                <div class="text-muted">Satisfactorio</div>
                            </div>
                        </div>
                        <div class="row text-center small mt-2">
                            <div class="col-4">
                                <div class="border-end">
                                    <span class="badge bg-danger mb-1">0-69</span>
                                    <div class="text-muted">Reprobado</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 bg-light shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold d-flex align-items-center mb-3">
                            <i class="bi bi-lightbulb text-warning me-2"></i>
                            Consejos Rápidos
                        </h6>
                        <ul class="list-unstyled text-muted small mb-0">
                            <li class="mb-1">
                                <i class="bi bi-check text-success me-1"></i>
                                Usa decimales para calificaciones precisas
                            </li>
                            <li class="mb-1">
                                <i class="bi bi-check text-success me-1"></i>
                                Guarda regularmente para no perder datos
                            </li>
                            <li>
                                <i class="bi bi-check text-success me-1"></i>
                                Revisa los promedios automáticamente calculados
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-gradient-info {
            background: linear-gradient(135deg, var(--bs-info) 0%, #6EB4C1 100%) !important;
        }
        .sticky-column {
            position: sticky;
            left: 0;
            z-index: 10;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        .sticky-top {
            position: sticky;
            top: 0;
            z-index: 20;
        }
        .calificacion-input {
            transition: all 0.3s ease;
            text-align: center;
        }
        .calificacion-input:focus {
            transform: scale(1.05);
            box-shadow: 0 0 0 2px var(--bs-primary);
        }
        .border-success {
            border-color: var(--bs-success) !important;
            background-color: rgba(var(--bs-success-rgb), 0.05);
        }
        .border-warning {
            border-color: var(--bs-warning) !important;
            background-color: rgba(var(--bs-warning-rgb), 0.05);
        }
        .border-danger {
            border-color: var(--bs-danger) !important;
            background-color: rgba(var(--bs-danger-rgb), 0.05);
        }
        .unidad-header {
            transition: all 0.3s ease;
        }
        .unidad-header.active {
            background-color: rgba(var(--bs-primary-rgb), 0.1) !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Calcular promedios y estados
            function calcularEstadisticas() {
                let sumaGrupo = 0;
                let estudiantesConDatos = 0;
                let aprobados = 0;
                let regulares = 0;
                let reprobados = 0;
                let unidadesCompletas = 0;

                // Contar unidades con al menos una calificación
                const unidadesConDatos = new Set();
                
                document.querySelectorAll('.estudiante-row').forEach(row => {
                    const estudianteId = row.querySelector('.calificacion-input')?.getAttribute('data-estudiante-id');
                    const inputs = row.querySelectorAll('.calificacion-input');
                    
                    let suma = 0;
                    let unidadesEstudiante = 0;
                    let tieneDatos = false;

                    inputs.forEach(input => {
                        const valor = parseFloat(input.value);
                        if (!isNaN(valor)) {
                            suma += valor;
                            unidadesEstudiante++;
                            tieneDatos = true;
                            unidadesConDatos.add(input.getAttribute('data-unidad'));
                        }
                    });

                    const promedio = unidadesEstudiante > 0 ? (suma / unidadesEstudiante).toFixed(1) : 0;
                    
                    // Actualizar display del promedio
                    const promedioElement = row.querySelector('.promedio-estudiante');
                    const estadoElement = row.querySelector('.estado-estudiante');
                    
                    if (promedioElement) {
                        promedioElement.textContent = promedio;
                        
                        if (tieneDatos) {
                            sumaGrupo += parseFloat(promedio);
                            estudiantesConDatos++;
                            
                            // Determinar estado
                            if (promedio >= 70) {
                                estadoElement.className = 'badge bg-success';
                                estadoElement.textContent = 'Aprobado';
                                aprobados++;
                            } else if (promedio >= 60) {
                                estadoElement.className = 'badge bg-warning';
                                estadoElement.textContent = 'Regular';
                                regulares++;
                            } else {
                                estadoElement.className = 'badge bg-danger';
                                estadoElement.textContent = 'Reprobado';
                                reprobados++;
                            }
                        } else {
                            estadoElement.className = 'badge bg-secondary';
                            estadoElement.textContent = 'Sin datos';
                        }
                    }
                });

                // Actualizar estadísticas globales
                const promedioGrupo = estudiantesConDatos > 0 ? (sumaGrupo / estudiantesConDatos).toFixed(1) : 0;
                document.getElementById('promedio-grupo').textContent = promedioGrupo;
                document.getElementById('estudiantes-aprobados').textContent = aprobados;
                document.getElementById('unidades-completas').textContent = unidadesConDatos.size;
                
                document.getElementById('resumen-aprobados').textContent = aprobados;
                document.getElementById('resumen-regulares').textContent = regulares;
                document.getElementById('resumen-reprobados').textContent = reprobados;
            }

            // Actualizar estadísticas cuando cambia una calificación
            document.querySelectorAll('.calificacion-input').forEach(input => {
                input.addEventListener('input', function() {
                    const valor = parseFloat(this.value);
                    
                    // Actualizar estilo basado en el valor
                    this.classList.remove('border-success', 'border-warning', 'border-danger');
                    if (!isNaN(valor)) {
                        if (valor >= 70) {
                            this.classList.add('border-success');
                        } else if (valor >= 60) {
                            this.classList.add('border-warning');
                        } else {
                            this.classList.add('border-danger');
                        }
                    }
                    
                    calcularEstadisticas();
                });
            });

            // Búsqueda de estudiantes
            document.getElementById('buscar-estudiante')?.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                document.querySelectorAll('.estudiante-row').forEach(row => {
                    const nombre = row.getAttribute('data-nombre');
                    if (nombre.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

            // Filtro por unidad
            document.querySelectorAll('.unidad-filter').forEach(filter => {
                filter.addEventListener('click', function(e) {
                    e.preventDefault();
                    const unidad = this.getAttribute('data-unidad');
                    
                    // Remover active de todos los headers
                    document.querySelectorAll('.unidad-header').forEach(header => {
                        header.classList.remove('active');
                    });
                    
                    // Mostrar/ocultar columnas
                    document.querySelectorAll('.unidad-cell').forEach(cell => {
                        if (unidad === 'all' || cell.getAttribute('data-unidad') === unidad) {
                            cell.style.display = '';
                            if (unidad !== 'all' && cell.getAttribute('data-unidad') === unidad) {
                                cell.closest('th')?.classList.add('active');
                            }
                        } else {
                            cell.style.display = 'none';
                        }
                    });
                });
            });

            // Acción: Aprobar todos (70+)
            document.getElementById('marcar-aprobados')?.addEventListener('click', function() {
                document.querySelectorAll('.calificacion-input').forEach(input => {
                    if (!input.value) {
                        input.value = '70.0';
                        input.dispatchEvent(new Event('input'));
                    }
                });
            });

            // Acción: Limpiar todas las calificaciones
            document.getElementById('limpiar-todas')?.addEventListener('click', function() {
                if (confirm('¿Estás seguro de que deseas limpiar todas las calificaciones?')) {
                    document.querySelectorAll('.calificacion-input').forEach(input => {
                        input.value = '';
                        input.classList.remove('border-success', 'border-warning', 'border-danger');
                        input.dispatchEvent(new Event('input'));
                    });
                }
            });

            // Prevenir envío duplicado del formulario
            let formSubmitted = false;
            document.getElementById('calificaciones-form')?.addEventListener('submit', function(e) {
                if (formSubmitted) {
                    e.preventDefault();
                    return;
                }
                
                // Mostrar loading state
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i> Guardando...';
                submitBtn.disabled = true;
                
                formSubmitted = true;
                
                // Re-enable after 3 seconds in case of error
                setTimeout(() => {
                    formSubmitted = false;
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 3000);
            });

            // Inicializar estadísticas
            calcularEstadisticas();
        });
    </script>
</x-app-layout>