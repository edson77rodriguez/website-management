<x-app-layout>
    <x-slot name="header">
        <div class="container">
            <h2 class="h4 fw-bold text-dark mb-0">
                Mi Historial Académico
            </h2>
            <p class="text-muted mb-0">Revisa tus calificaciones y tu historial de asistencias.</p>
        </div>
    </x-slot>

    <div class="container">
        <div class="row mb-4 g-4">
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-primary bg-opacity-10 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="text-primary mb-2">Promedio General</h6>
                                <h3 class="fw-bold text-primary mb-0" id="promedio-general">0.0</h3>
                                <small class="text-muted">de 100 puntos</small>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="bi bi-graph-up display-6 text-primary opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-success bg-opacity-10 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="text-success mb-2">Materias Aprobadas</h6>
                                <h3 class="fw-bold text-success mb-0" id="materias-aprobadas">0</h3>
                                <small class="text-muted">de {{ $calificacionesAgrupadas->count() }} total</small>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="bi bi-check-circle display-6 text-success opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-info bg-opacity-10 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="text-info mb-2">Asistencia General</h6>
                                <h3 class="fw-bold text-info mb-0" id="asistencia-general">0%</h3>
                                <small class="text-muted">porcentaje total</small>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="bi bi-clipboard-check display-6 text-info opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 bg-warning bg-opacity-10 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="text-warning mb-2">Unidades Calificadas</h6>
                                <h3 class="fw-bold text-warning mb-0" id="unidades-completadas">0</h3>
                                <small class="text-muted">total de unidades</small>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="bi bi-layers display-6 text-warning opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3 border-0">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h5 class="card-title fw-bold mb-0" style="font-family: 'Georgia', serif;">
                                    <i class="bi bi-pencil-square text-primary me-2"></i>
                                    Mis Calificaciones
                                </h5>
                                <p class="text-muted mb-0 mt-1 small">
                                    Detalle de calificaciones por materia y unidad
                                </p>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex gap-2 justify-content-md-end">
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-funnel me-1"></i>
                                            Filtrar
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item filter-materia active" href="#" data-filter="all">Todas las materias</a></li>
                                            <li><a class="dropdown-item filter-materia" href="#" data-filter="aprobada">Solo aprobadas</a></li>
                                            <li><a class="dropdown-item filter-materia" href="#" data-filter="reprobada">Solo reprobadas</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        @if($calificacionesAgrupadas->count() > 0)
                        <div class="accordion accordion-flush" id="accordionCalificaciones">
                            
                            @foreach ($calificacionesAgrupadas as $asignacion_id => $calificaciones)
                                @php
                                    $materia = $calificaciones->first()->asignacion->materia;
                                    $promedio = $calificaciones->avg('calificacion');
                                    $estado = $promedio >= 70 ? 'aprobada' : 'reprobada';
                                    $colorEstado = $promedio >= 70 ? 'success' : ($promedio >= 60 ? 'warning' : 'danger');
                                    $iconoEstado = $promedio >= 70 ? 'check-circle' : ($promedio >= 60 ? 'exclamation-circle' : 'x-circle');
                                @endphp

                                <div class="accordion-item border-bottom materia-item" data-estado="{{ $estado }}" data-promedio="{{ $promedio }}" data-unidades="{{ $calificaciones->count() }}">
                                    <h2 class="accordion-header" id="heading-{{ $asignacion_id }}">
                                        <button class="accordion-button collapsed py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $asignacion_id }}">
                                            <div class="d-flex align-items-center w-100">
                                                <div class="bg-{{ $colorEstado }} bg-opacity-10 rounded-circle p-2 me-3 flex-shrink-0">
                                                    <i class="bi bi-{{ $iconoEstado }} text-{{ $colorEstado }}"></i>
                                                </div>
                                                <div class="flex-grow-1 text-start">
                                                    <h6 class="fw-bold text-dark mb-1">{{ $materia->nombre_materia }}</h6>
                                                    <div class="d-flex align-items-center">
                                                        <small class="text-muted me-3">
                                                            <i class="bi bi-layers me-1"></i>
                                                            {{ $calificaciones->count() }} unidades
                                                        </small>
                                                        @if($materia->clave_materia)
                                                        <small class="text-info">
                                                            <i class="bi bi-key me-1"></i>
                                                            {{ $materia->clave_materia }}
                                                        </small>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0 text-end">
                                                    <div class="fw-bold fs-5 text-{{ $colorEstado }} mb-1">
                                                        {{ number_format($promedio, 1) }}
                                                    </div>
                                                    <span class="badge bg-{{ $colorEstado }} bg-opacity-10 text-{{ $colorEstado }} border-0">
                                                        {{ $promedio >= 70 ? 'Aprobada' : ($promedio >= 60 ? 'Regular' : 'Reprobada') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="collapse-{{ $asignacion_id }}" class="accordion-collapse collapse" data-bs-parent="#accordionCalificaciones">
                                        <div class="accordion-body p-0">
                                            <div class="bg-light py-3 px-4 border-bottom">
                                                <div class="row align-items-center">
                                                    <div class="col-md-12">
                                                        <div class="d-flex justify-content-between small text-muted mb-1">
                                                            <span>Progreso</span>
                                                            <span>{{ number_format($promedio, 1) }}/100</span>
                                                        </div>
                                                        <div class="progress" style="height: 8px;">
                                                            <div class="progress-bar bg-{{ $colorEstado }}" 
                                                                 role="progressbar" 
                                                                 style="width: {{ $promedio }}%"
                                                                 aria-valuenow="{{ $promedio }}" 
                                                                 aria-valuemin="0" 
                                                                 aria-valuemax="100">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="table table-hover align-middle mb-0">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th class="ps-4">Unidad</th>
                                                            <th class="text-center">Calificación</th>
                                                            <th class="text-center">Estado</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($calificaciones->sortBy('numero_unidad') as $calif)
                                                            @php
                                                                $colorNota = $calif->calificacion >= 70 ? 'success' : ($calif->calificacion >= 60 ? 'warning' : 'danger');
                                                                $estadoNota = $calif->calificacion >= 70 ? 'Excelente' : ($calif->calificacion >= 60 ? 'Regular' : 'Deficiente');
                                                            @endphp
                                                            <tr>
                                                                <td class="ps-4">
                                                                    <span class="fw-medium">Unidad {{ $calif->numero_unidad }}</span>
                                                                </td>
                                                                <td class="text-center">
                                                                    <span class="fw-bold fs-5 text-{{ $colorNota }}">
                                                                        {{ number_format($calif->calificacion, 1) }}
                                                                    </span>
                                                                </td>
                                                                <td class="text-center">
                                                                    <span class="badge bg-{{ $colorNota }} bg-opacity-10 text-{{ $colorNota }} border-0">
                                                                        {{ $estadoNota }}
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @else
                        <div class="text-center py-5">
                            <i class="bi bi-journal-x display-4 text-muted opacity-50"></i>
                            <h5 class="text-muted mt-3">No hay calificaciones registradas</h5>
                            <p class="text-muted mb-4">Tus calificaciones aparecerán aquí una vez que los docentes las registren.</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3 border-0">
                        <h5 class="card-title fw-bold mb-0" style="font-family: 'Georgia', serif;">
                            <i class="bi bi-clipboard-check text-primary me-2"></i>
                            Resumen de Asistencias
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        @if($resumenAsistencias->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach ($resumenAsistencias as $asignacion_id => $asistencias)
                                @php
                                    $materia = $asistencias->first()->asignacion->materia;
                                    $totalAsistencias = $asistencias->sum('total');
                                    $presentes = $asistencias->where('estado', 'Presente')->first()->total ?? 0;
                                    $ausentes = $asistencias->where('estado', 'Ausente')->first()->total ?? 0;
                                    $retardos = $asistencias->where('estado', 'Retardo')->first()->total ?? 0;
                                    $justificados = $asistencias->where('estado', 'Justificado')->first()->total ?? 0;
                                    
                                    // Cálculo de asistencia: Presente, Justificado y 0.5 por Retardo
                                    $asistenciaEfectiva = $presentes + $justificados + ($retardos * 0.5);
                                    $porcentajeAsistencia = $totalAsistencias > 0 ? ($asistenciaEfectiva / $totalAsistencias) * 100 : 0;
                                    $colorAsistencia = $porcentajeAsistencia >= 80 ? 'success' : ($porcentajeAsistencia >= 60 ? 'warning' : 'danger');
                                @endphp
                                <div class="list-group-item p-3 materia-asistencia" data-total-presentes="{{ $presentes + $justificados + ($retardos * 0.5) }}" data-total-asistencias="{{ $totalAsistencias }}">
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="flex-grow-1">
                                            <h6 class="fw-bold text-dark mb-1">{{ $materia->nombre_materia }}</h6>
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="badge bg-{{ $colorAsistencia }} bg-opacity-10 text-{{ $colorAsistencia }} border-0 me-2">
                                                    {{ number_format($porcentajeAsistencia, 1) }}%
                                                </span>
                                                <small class="text-muted">de asistencia</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-2 text-center">
                                        <div class="col-3">
                                            <div class="bg-success bg-opacity-10 rounded p-2">
                                                <div class="fw-bold text-success mb-1">{{ $presentes }}</div>
                                                <small class="text-muted" style="font-size: 0.75em;">Presente</small>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="bg-danger bg-opacity-10 rounded p-2">
                                                <div class="fw-bold text-danger mb-1">{{ $ausentes }}</div>
                                                <small class="text-muted" style="font-size: 0.75em;">Ausente</small>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="bg-warning bg-opacity-10 rounded p-2">
                                                <div class="fw-bold text-warning mb-1">{{ $retardos }}</div>
                                                <small class="text-muted" style="font-size: 0.75em;">Retardo</small>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="bg-info bg-opacity-10 rounded p-2">
                                                <div class="fw-bold text-info mb-1">{{ $justificados }}</div>
                                                <small class="text-muted" style="font-size: 0.75em;">Justif.</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @else
                        <div class="text-center py-4">
                            <i class="bi bi-clipboard-x display-4 text-muted opacity-50 mb-3"></i>
                            <h6 class="text-muted">No hay asistencias registradas</h6>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-0">
             <div class="col-12">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3 border-0">
                        <h5 class="card-title fw-bold mb-0" style="font-family: 'Georgia', serif;">
                            <i class="bi bi-calendar-check text-primary me-2"></i>
                            Calendario de Asistencias
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div id="calendario-asistencias"></div>
                        <div class="mt-3">
                            <div class="d-flex justify-content-center flex-wrap gap-3">
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-success me-2" style="width: 15px; height: 15px;">&nbsp;</span>
                                    <small>Presente</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-danger me-2" style="width: 15px; height: 15px;">&nbsp;</span>
                                    <small>Ausente</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-warning me-2" style="width: 15px; height: 15px;">&nbsp;</span>
                                    <small>Retardo</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-info me-2" style="width: 15px; height: 15px;">&nbsp;</span>
                                    <small>Justificado</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <style>
        .accordion-button:not(.collapsed) {
            background-color: rgba(var(--bs-primary-rgb), 0.05);
            border-color: var(--bs-primary);
        }
        .materia-item {
            transition: all 0.3s ease;
        }
        .materia-item:hover {
            background-color: rgba(var(--bs-primary-rgb), 0.02);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Calcular estadísticas generales
            function calcularEstadisticasGenerales() {
                let sumaPromedios = 0;
                let materiasConPromedio = 0;
                let materiasAprobadas = 0;
                let totalUnidades = 0;
                let totalAsistenciasEfectivas = 0;
                let totalAsistenciasPosibles = 0;

                // Calcular promedios y materias aprobadas
                document.querySelectorAll('.materia-item').forEach(item => {
                    const promedio = parseFloat(item.getAttribute('data-promedio') || 0);
                    if (promedio > 0) {
                        sumaPromedios += promedio;
                        materiasConPromedio++;
                        if (promedio >= 70) {
                            materiasAprobadas++;
                        }
                    }
                    
                    // Contar unidades
                    const unidades = parseInt(item.getAttribute('data-unidades') || 0);
                    totalUnidades += unidades;
                });

                // Calcular asistencia general
                document.querySelectorAll('.materia-asistencia').forEach(item => {
                    totalAsistenciasEfectivas += parseFloat(item.getAttribute('data-total-presentes') || 0);
                    totalAsistenciasPosibles += parseFloat(item.getAttribute('data-total-asistencias') || 0);
                });

                // Actualizar estadísticas
                const promedioGeneral = materiasConPromedio > 0 ? (sumaPromedios / materiasConPromedio).toFixed(1) : '0.0';
                const asistenciaGeneral = totalAsistenciasPosibles > 0 ?
                    ((totalAsistenciasEfectivas / totalAsistenciasPosibles) * 100).toFixed(1) : '0.0';

                document.getElementById('promedio-general').textContent = promedioGeneral;
                document.getElementById('materias-aprobadas').textContent = materiasAprobadas;
                document.getElementById('asistencia-general').textContent = asistenciaGeneral + '%';
                document.getElementById('unidades-completadas').textContent = totalUnidades;
                
                // Actualizar la tarjeta de info (si existe)
                const infoUnidades = document.getElementById('info-unidades');
                if (infoUnidades) {
                    infoUnidades.textContent = totalUnidades;
                }
            }

            // Filtros de materias
            document.querySelectorAll('.filter-materia').forEach(filter => {
                filter.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    document.querySelectorAll('.filter-materia').forEach(f => f.classList.remove('active'));
                    this.classList.add('active');
                    
                    const filtro = this.getAttribute('data-filter');
                    
                    document.querySelectorAll('.materia-item').forEach(item => {
                        if (filtro === 'all') {
                            item.style.display = '';
                        } else {
                            // Usamos data-estado="aprobada" o "reprobada"
                            item.style.display = item.getAttribute('data-estado') === filtro ? '' : 'none';
                        }
                    });
                });
            });

            // Inicializar estadísticas
            calcularEstadisticasGenerales();
        });
    </script>

    @include('estudiante.historial.partials.calendar-scripts')
</x-app-layout>