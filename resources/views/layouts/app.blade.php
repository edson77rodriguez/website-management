<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
      
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Georgia:wght@700&display=swap" rel="stylesheet">
    
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
        @push('styles')
    <link href='https://unpkg.com/@fullcalendar/core@6.1.8/main.min.css' rel='stylesheet' />
    <link href='https://unpkg.com/@fullcalendar/daygrid@6.1.8/main.min.css' rel='stylesheet' />

    <style>
    /* Estilos personalizados para el calendario */
    .fc { font-family: inherit; }
    .fc .fc-toolbar-title { font-size: 1.2em; font-weight: bold; }
    .fc .fc-button { background-color: #f8f9fa; border-color: #dee2e6; color: #212529; }
    .fc .fc-button-primary:not(:disabled).fc-button-active,
    .fc .fc-button-primary:not(:disabled):active { background-color: #0d6efd; border-color: #0d6efd; }
    .fc-daygrid-event { border-radius: 3px; padding: 2px 4px; font-size: 0.8em; color: #fff; }
    .fc-event-title { color: #fff !important; }
    </style>
@endpush
    </head>
    
    <body class="bg-light">
        <div class="d-flex flex-column min-vh-100">
            
            <!-- Navigation Bar Modernizada -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm border-bottom">
                <div class="container">
                    <!-- Brand con mejor jerarquía -->
                    <a class="navbar-brand fw-bold text-primary d-flex align-items-center" href="{{ route('dashboard') }}">
                        <i class="bi bi-journal-bookmark-fill me-2"></i>
                        <span style="font-family: 'Georgia', serif;">Academic Management</span>
                    </a>

                    <!-- Toggler con mejor estilo -->
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainAppNav" aria-controls="mainAppNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- Navigation Items Mejorados -->
                    <div class="collapse navbar-collapse" id="mainAppNav">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center py-3 px-3 rounded-3 {{ request()->routeIs('dashboard') ? 'active bg-primary text-white' : 'text-dark' }}" 
                                   href="{{ route('dashboard') }}">
                                    <i class="bi bi-speedometer2 me-2"></i>
                                    Dashboard
                                </a>
                            </li>

                            @if(Auth::user()->isAdministrador())
                            <!-- Menu Administrador Mejorado -->
                            <li class="nav-item dropdown">
                                <a class="nav-link d-flex align-items-center py-3 px-3 rounded-3 dropdown-toggle {{ request()->routeIs('admin.users.*') ? 'active bg-primary text-white' : 'text-dark' }}" 
                                   href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-people me-2"></i>
                                    Gestión Usuarios
                                </a>
                                <ul class="dropdown-menu shadow border-0">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center py-2" 
                                           href="{{ route('admin.usuarios.index') }}">
                                            <i class="bi bi-list-ul me-2"></i>
                                            Lista de Usuarios
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center py-2" 
                                           href="{{ route('admin.usuarios.create') }}">
                                            <i class="bi bi-person-plus me-2"></i>
                                            Nuevo Usuario
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link d-flex align-items-center py-3 px-3 rounded-3 dropdown-toggle {{ (request()->routeIs('admin.semestres.*') || request()->routeIs('admin.grupos.*') || request()->routeIs('admin.materias.*')) ? 'active bg-primary text-white' : 'text-dark' }}" 
                                   href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-book me-2"></i>
                                    Gestión Académica
                                </a>
                                <ul class="dropdown-menu shadow border-0">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center py-2" 
                                           href="{{ route('admin.semestres.index') }}">
                                            <i class="bi bi-calendar-range me-2"></i>
                                            Semestres
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center py-2" 
                                           href="{{ route('admin.grupos.index') }}">
                                            <i class="bi bi-collection me-2"></i>
                                            Grupos
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center py-2" 
                                           href="{{ route('admin.materias.index') }}">
                                            <i class="bi bi-journal-text me-2"></i>
                                            Materias
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center py-3 px-3 rounded-3 {{ request()->routeIs('admin.asignaciones.*') ? 'active bg-primary text-white' : 'text-dark' }}" 
                                   href="{{ route('admin.asignaciones.index') }}">
                                    <i class="bi bi-clipboard-check me-2"></i>
                                    Asignaciones
                                </a>
                            </li>
                            @elseif(Auth::user()->isDocente())
                            <!-- Menu Docente Mejorado -->
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center py-3 px-3 rounded-3 {{ request()->routeIs('docente.asistencia.*') ? 'active bg-primary text-white' : 'text-dark' }}" 
                                   href="{{ route('docente.asistencia.index') }}">
                                    <i class="bi bi-clipboard-data me-2"></i>
                                    Tomar Asistencia
                                </a>
                            </li>
                            @elseif(Auth::user()->isEstudiante())
                            <!-- Menu Estudiante Mejorado -->
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center py-3 px-3 rounded-3 {{ request()->routeIs('estudiante.historial.*') ? 'active bg-primary text-white' : 'text-dark' }}" 
                                   href="{{ route('estudiante.historial.index') }}">
                                    <i class="bi bi-graph-up me-2"></i>
                                    Mi Historial
                                </a>
                            </li>
                            @endif
                        </ul>

                        <!-- User Dropdown Mejorado -->
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center py-2 px-3 rounded-3 bg-light" 
                                   href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-circle me-2 text-primary"></i>
                                    <span class="fw-medium">{{ Auth::user()->nombre }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('profile.edit') }}">
                                            <i class="bi bi-person me-2"></i>
                                            Perfil
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider my-2"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a class="dropdown-item d-flex align-items-center py-2 text-danger" 
                                               href="{{ route('logout') }}"
                                               onclick="event.preventDefault(); this.closest('form').submit();">
                                                <i class="bi bi-box-arrow-right me-2"></i>
                                                Cerrar Sesión
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Main Content con mejor estructura -->
            <main class="flex-grow-1 py-4">
                <div class="container">
                    <!-- Breadcrumb opcional para mejor navegación -->
                    @if(!request()->routeIs('dashboard'))
                    <nav aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $title ?? 'Página Actual' }}</li>
                        </ol>
                    </nav>
                    @endif

                    <!-- Slot principal con card container -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </main>

            <!-- Footer Mejorado -->
            <footer class="text-center py-4 bg-white shadow-top border-top mt-auto">
                <div class="container">
                    <span class="text-muted small">
                        <i class="bi bi-c-circle me-1"></i>
                        {{ date('Y') }} Academic Management - Sistema de Gestión Académica
                    </span>
                </div>
            </footer>
        </div>
        </div> @push('scripts')
    <script src='https://unpkg.com/@fullcalendar/core@6.1.8/index.global.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/daygrid@6.1.8/index.global.min.js'></script>
    
    <script src='https://unpkg.com/@fullcalendar/core@6.1.8/locales-all.global.min.js'></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendario-asistencias');
        if (calendarEl) {
            
            // Verificamos si la variable existe (para evitar errores si no estamos en la pág. del historial)
            var calendarEvents = typeof eventosCalendario !== 'undefined' ? eventosCalendario : @json($eventosCalendario ?? []);

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es', // Usar el idioma español
                height: 'auto',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: ''
                },
                events: calendarEvents,
                eventDidMount: function(info) {
                    info.el.title = info.event.title;
                },
                dayMaxEvents: true,
                displayEventTime: false,
                firstDay: 1,
            });
            calendar.render();
        }
    });
    </script>
@endpush
    </body>
</html>