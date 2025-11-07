<x-app-layout>
    <x-slot name="header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="h2 fw-bold text-dark mb-0" style="font-family: 'Georgia', serif;">
                        Tomar Asistencia
                    </h1>
                    <nav aria-label="breadcrumb" class="mt-2">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('docente.asistencia.index') }}" class="text-decoration-none">Mis Clases</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Asistencia</li>
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
        <!-- Información de la Clase -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 bg-gradient-primary text-white shadow-lg">
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
                                            <i class="bi bi-clock me-2 opacity-75"></i>
                                            <div>
                                                <small class="opacity-75">Turno</small>
                                                <div class="fw-bold">{{ $asignacion->grupo->turno }}</div>
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
                                            <i class="bi bi-calendar3 me-2 opacity-75"></i>
                                            <div>
                                                <small class="opacity-75">Fecha</small>
                                                <div class="fw-bold">{{ $hoy->isoFormat('D/M/YYYY') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-center text-md-end">
                                <div class="bg-white bg-opacity-20 rounded-circle p-4 d-inline-flex">
                                    <i class="bi bi-clipboard-check display-4 opacity-75"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resumen Rápido -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-success bg-opacity-10 shadow-sm">
                    <div class="card-body text-center p-3">
                        <h4 class="fw-bold text-success mb-1" id="presentes-count">0</h4>
                        <small class="text-muted">Presentes</small>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-danger bg-opacity-10 shadow-sm">
                    <div class="card-body text-center p-3">
                        <h4 class="fw-bold text-danger mb-1" id="ausentes-count">0</h4>
                        <small class="text-muted">Ausentes</small>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-warning bg-opacity-10 shadow-sm">
                    <div class="card-body text-center p-3">
                        <h4 class="fw-bold text-warning mb-1" id="retardos-count">0</h4>
                        <small class="text-muted">Retardos</small>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-info bg-opacity-10 shadow-sm">
                    <div class="card-body text-center p-3">
                        <h4 class="fw-bold text-info mb-1">{{ $estudiantes->count() }}</h4>
                        <small class="text-muted">Total</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulario de Asistencia -->
        <div class="row justify-content-center">
            <div class="col-12">
                <form action="{{ route('docente.asistencia.store', $asignacion) }}" method="POST" id="asistencia-form">
                    @csrf
                    
                    <div class="card border-0 shadow-lg">
                        <div class="card-header bg-white py-4 border-0">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h5 class="card-title fw-bold mb-0" style="font-family: 'Georgia', serif;">
                                        <i class="bi bi-list-check text-primary me-2"></i>
                                        Lista de Estudiantes
                                    </h5>
                                    <p class="text-muted mb-0 mt-1 small">
                                        Marca la asistencia para cada estudiante
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex gap-2 justify-content-md-end">
                                        <!-- Acciones Rápidas -->
                                        <button type="button" class="btn btn-outline-success btn-sm" id="marcar-todos-presentes">
                                            <i class="bi bi-check-all me-1"></i> Todos Presentes
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm" id="limpiar-todos">
                                            <i class="bi bi-arrow-clockwise me-1"></i> Limpiar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            @if($estudiantes->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" class="ps-4" style="width: 50px;">#</th>
                                            <th scope="col">Estudiante</th>
                                            <th scope="col" class="text-center">Estado Actual</th>
                                            <th scope="col" class="text-center" style="width: 300px;">Asistencia de Hoy</th>
                                            <th scope="col" class="text-center">Historial</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($estudiantes as $index => $estudiante)
                                            @php
                                                $estadoActual = $asistenciasHoy[$estudiante->id] ?? 'Presente';
                                            @endphp
                                            <tr class="hover-shadow">
                                                <th scope="row" class="ps-4 fw-normal text-muted">{{ $index + 1 }}</th>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                            <i class="bi bi-person text-primary"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0 fw-bold">
                                                                {{ $estudiante->user->apellido_paterno }} 
                                                                {{ $estudiante->user->apellido_materno }}, 
                                                                {{ $estudiante->user->nombre }}
                                                            </h6>
                                                            <small class="text-muted">
                                                                Matrícula: {{ $estudiante->matricula ?? 'N/A' }}
                                                            </small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    @if($estadoActual == 'Presente')
                                                        <span class="badge bg-success bg-opacity-10 text-success border-0 py-2">
                                                            <i class="bi bi-check-circle me-1"></i>
                                                            Presente
                                                        </span>
                                                    @elseif($estadoActual == 'Ausente')
                                                        <span class="badge bg-danger bg-opacity-10 text-danger border-0 py-2">
                                                            <i class="bi bi-x-circle me-1"></i>
                                                            Ausente
                                                        </span>
                                                    @else
                                                        <span class="badge bg-warning bg-opacity-10 text-warning border-0 py-2">
                                                            <i class="bi bi-clock-history me-1"></i>
                                                            Retardo
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group w-100" role="group" aria-label="Estado de asistencia">
                                                        <input type="radio" class="btn-check asistencia-radio" 
                                                               name="asistencias[{{ $estudiante->id }}]" 
                                                               id="presente-{{ $estudiante->id }}" 
                                                               value="Presente" 
                                                               data-student-id="{{ $estudiante->id }}"
                                                               @checked($estadoActual == 'Presente')>
                                                        <label class="btn btn-outline-success" for="presente-{{ $estudiante->id }}">
                                                            <i class="bi bi-check-circle-fill me-1"></i>
                                                            Presente
                                                        </label>

                                                        <input type="radio" class="btn-check asistencia-radio" 
                                                               name="asistencias[{{ $estudiante->id }}]" 
                                                               id="ausente-{{ $estudiante->id }}" 
                                                               value="Ausente"
                                                               data-student-id="{{ $estudiante->id }}"
                                                               @checked($estadoActual == 'Ausente')>
                                                        <label class="btn btn-outline-danger" for="ausente-{{ $estudiante->id }}">
                                                            <i class="bi bi-x-circle-fill me-1"></i>
                                                            Ausente
                                                        </label>

                                                        <input type="radio" class="btn-check asistencia-radio" 
                                                               name="asistencias[{{ $estudiante->id }}]" 
                                                               id="retardo-{{ $estudiante->id }}" 
                                                               value="Retardo"
                                                               data-student-id="{{ $estudiante->id }}"
                                                               @checked($estadoActual == 'Retardo')>
                                                        <label class="btn btn-outline-warning" for="retardo-{{ $estudiante->id }}">
                                                            <i class="bi bi-clock-history me-1"></i>
                                                            Retardo
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-info" 
                                                            data-bs-toggle="tooltip" title="Ver historial de asistencia">
                                                        <i class="bi bi-graph-up"></i>
                                                    </button>
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
                                            <i class="bi bi-info-circle text-primary"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Resumen de asistencia</small>
                                            <small class="fw-bold">
                                                <span class="text-success" id="summary-presentes">0</span> presentes • 
                                                <span class="text-danger" id="summary-ausentes">0</span> ausentes • 
                                                <span class="text-warning" id="summary-retardos">0</span> retardos
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
                                            Guardar Asistencia
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
    </div>

    <style>
        .hover-shadow:hover {
            box-shadow: inset 0 0 0 1px var(--bs-primary), 0 2px 8px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        .bg-gradient-primary {
            background: linear-gradient(135deg, var(--bs-primary) 0%, #6EB4C1 100%) !important;
        }
        .btn-check:checked + .btn-outline-success {
            background-color: var(--bs-success);
            border-color: var(--bs-success);
            color: white;
        }
        .btn-check:checked + .btn-outline-danger {
            background-color: var(--bs-danger);
            border-color: var(--bs-danger);
            color: white;
        }
        .btn-check:checked + .btn-outline-warning {
            background-color: var(--bs-warning);
            border-color: var(--bs-warning);
            color: white;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })

            // Contadores de asistencia
            function updateCounters() {
                const presentes = document.querySelectorAll('input[value="Presente"]:checked').length;
                const ausentes = document.querySelectorAll('input[value="Ausente"]:checked').length;
                const retardos = document.querySelectorAll('input[value="Retardo"]:checked').length;
                
                document.getElementById('presentes-count').textContent = presentes;
                document.getElementById('ausentes-count').textContent = ausentes;
                document.getElementById('retardos-count').textContent = retardos;
                
                document.getElementById('summary-presentes').textContent = presentes;
                document.getElementById('summary-ausentes').textContent = ausentes;
                document.getElementById('summary-retardos').textContent = retardos;
            }

            // Actualizar contadores cuando cambia la selección
            document.querySelectorAll('.asistencia-radio').forEach(radio => {
                radio.addEventListener('change', updateCounters);
            });

            // Acción: Marcar todos como presentes
            document.getElementById('marcar-todos-presentes')?.addEventListener('click', function() {
                document.querySelectorAll('.asistencia-radio[value="Presente"]').forEach(radio => {
                    radio.checked = true;
                    // Disparar evento change para actualizar UI
                    radio.dispatchEvent(new Event('change'));
                });
                updateCounters();
            });

            // Acción: Limpiar todas las selecciones
            document.getElementById('limpiar-todos')?.addEventListener('click', function() {
                document.querySelectorAll('.asistencia-radio').forEach(radio => {
                    radio.checked = false;
                });
                updateCounters();
            });

            // Inicializar contadores
            updateCounters();

            // Prevenir envío duplicado del formulario
            let formSubmitted = false;
            document.getElementById('asistencia-form')?.addEventListener('submit', function(e) {
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
        });
    </script>
</x-app-layout>