<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Academic Management - Moderniza tu Gestión Académica</title>
    <meta name="description" content="Solución integral para automatizar procesos académicos, centralizar información y optimizar la gestión educativa institucional.">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700&family=Georgia:wght@700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body class="antialiased">
    
    <!-- Navigation Bar Mejorada -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary d-flex align-items-center" href="{{ url('/') }}">
                <i class="bi bi-journal-bookmark-fill me-2"></i>
                <span style="font-family: 'Georgia', serif;">Academic Management</span>
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="main-nav">
                <div class="ms-auto">
                    @if (Route::has('login'))
                        <div class="d-flex align-items-center gap-2">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-outline-primary d-flex align-items-center">
                                    <i class="bi bi-speedometer2 me-2"></i>
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-primary d-flex align-items-center">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>
                                    Iniciar Sesión
                                </a>
                                
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-primary d-flex align-items-center">
                                        <i class="bi bi-person-plus me-2"></i>
                                        Crear Cuenta
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <main>
        <!-- Hero Section Mejorada -->
        <section class="hero-section position-relative overflow-hidden">
            <div class="container">
                <div class="row justify-content-center align-items-center min-vh-100 py-5">
                    <div class="col-lg-8 col-xl-7 text-center text-lg-start">
                        <div class="pe-lg-4">
                            <!-- Badge de características -->
                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-4 d-inline-flex align-items-center">
                                <i class="bi bi-stars me-2"></i>
                                Plataforma Todo-en-Uno
                            </span>
                            
                            <h1 class="display-4 fw-bold mb-4" style="font-family: 'Georgia', serif; line-height: 1.2;">
                                Transforma la <span class="text-primary">Gestión Académica</span> de tu Institución
                            </h1>
                            
                            <p class="lead text-dark-emphasis mb-5 fs-5" style="font-family: 'Roboto', sans-serif; font-weight: 400;">
                                Sistema integral que automatiza procesos, centraliza información y optimiza 
                                la experiencia educativa para administradores, docentes y estudiantes.
                            </p>
                            
                            <div class="d-flex flex-column flex-sm-row gap-3 justify-content-lg-start justify-content-center">
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-4 py-3 d-inline-flex align-items-center justify-content-center">
                                        <i class="bi bi-rocket-takeoff me-2"></i>
                                        Comenzar Gratis
                                    </a>
                                @endif
                                
                                <a href="#features" class="btn btn-outline-primary btn-lg px-4 py-3 d-inline-flex align-items-center justify-content-center">
                                    <i class="bi bi-play-circle me-2"></i>
                                    Ver Demo
                                </a>
                            </div>
                            
                            <!-- Trust indicators -->
                            <div class="mt-5 pt-3">
                                <p class="text-muted small mb-3">Únete a instituciones que ya confían en nosotros</p>
                                <div class="d-flex justify-content-lg-start justify-content-center gap-4 opacity-75">
                                    <div class="text-center">
                                        <div class="h5 fw-bold text-primary mb-1">500+</div>
                                        <div class="small text-muted">Usuarios</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="h5 fw-bold text-primary mb-1">50+</div>
                                        <div class="small text-muted">Instituciones</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="h5 fw-bold text-primary mb-1">99%</div>
                                        <div class="small text-muted">Satisfacción</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-xl-5 mt-5 mt-lg-0">
                        <div class="position-relative">
                            <!-- Hero Illustration Placeholder -->
                            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                                <div class="card-body p-4 bg-gradient-primary text-white text-center">
                                    <i class="bi bi-laptop display-1 mb-3 d-block"></i>
                                    <h5 class="mb-0">Dashboard Interactivo</h5>
                                    <p class="small opacity-75 mb-0">Vista previa de la plataforma</p>
                                </div>
                            </div>
                            
                            <!-- Floating elements -->
                            <div class="position-absolute top-0 start-0 translate-middle">
                                <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                                    <i class="bi bi-graph-up text-warning fs-4"></i>
                                </div>
                            </div>
                            <div class="position-absolute bottom-0 end-0 translate-middle">
                                <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                                    <i class="bi bi-check-circle text-success fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section Mejorada -->
        <section id="features" class="py-5 bg-white">
            <div class="container">
                <div class="row justify-content-center text-center mb-5">
                    <div class="col-lg-8">
                        <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill mb-3">
                            Características Principales
                        </span>
                        <h2 class="display-5 fw-bold mb-3" style="font-family: 'Georgia', serif;">
                            Todo lo que necesitas en una <span class="text-primary">sola plataforma</span>
                        </h2>
                        <p class="lead text-dark-emphasis">
                            Diseñada específicamente para optimizar la gestión educativa moderna
                        </p>
                    </div>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm h-100 hover-lift">
                            <div class="card-body p-4 text-center">
                                <div class="bg-primary bg-opacity-10 p-3 rounded-circle d-inline-flex mb-4">
                                    <i class="bi bi-card-checklist text-primary fs-2"></i>
                                </div>
                                <h4 class="h5 fw-bold mb-3" style="font-family: 'Georgia', serif;">Control de Asistencia Inteligente</h4>
                                <p class="text-secondary-emphasis mb-0">
                                    Automatiza el registro de asistencias con validación en tiempo real, 
                                    reportes automáticos y notificaciones instantáneas para ausencias recurrentes.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm h-100 hover-lift">
                            <div class="card-body p-4 text-center">
                                <div class="bg-primary bg-opacity-10 p-3 rounded-circle d-inline-flex mb-4">
                                    <i class="bi bi-pencil-square text-primary fs-2"></i>
                                </div>
                                <h4 class="h5 fw-bold mb-3" style="font-family: 'Georgia', serif;">Gestión de Calificaciones</h4>
                                <p class="text-secondary-emphasis mb-0">
                                    Portal centralizado para registro, consulta y análisis de calificaciones 
                                    con gráficos interactivos y reportes de progreso académico.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm h-100 hover-lift">
                            <div class="card-body p-4 text-center">
                                <div class="bg-primary bg-opacity-10 p-3 rounded-circle d-inline-flex mb-4">
                                    <i class="bi bi-people-fill text-primary fs-2"></i>
                                </div>
                                <h4 class="h5 fw-bold mb-3" style="font-family: 'Georgia', serif;">Portales Multi-Usuario</h4>
                                <p class="text-secondary-emphasis mb-0">
                                    Experiencias personalizadas para Administradores, Docentes y Estudiantes, 
                                    cada uno con herramientas específicas para sus necesidades.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Additional Features -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm h-100 hover-lift">
                            <div class="card-body p-4 text-center">
                                <div class="bg-primary bg-opacity-10 p-3 rounded-circle d-inline-flex mb-4">
                                    <i class="bi bi-bar-chart text-primary fs-2"></i>
                                </div>
                                <h4 class="h5 fw-bold mb-3" style="font-family: 'Georgia', serif;">Analíticas en Tiempo Real</h4>
                                <p class="text-secondary-emphasis mb-0">
                                    Dashboard interactivo con métricas clave, tendencias académicas 
                                    y reportes ejecutivos para la toma de decisiones informadas.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm h-100 hover-lift">
                            <div class="card-body p-4 text-center">
                                <div class="bg-primary bg-opacity-10 p-3 rounded-circle d-inline-flex mb-4">
                                    <i class="bi bi-shield-check text-primary fs-2"></i>
                                </div>
                                <h4 class="h5 fw-bold mb-3" style="font-family: 'Georgia', serif;">Seguridad Avanzada</h4>
                                <p class="text-secondary-emphasis mb-0">
                                    Protección de datos académicos con encriptación, controles de acceso 
                                    por roles y cumplimiento de normativas de privacidad educativa.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm h-100 hover-lift">
                            <div class="card-body p-4 text-center">
                                <div class="bg-primary bg-opacity-10 p-3 rounded-circle d-inline-flex mb-4">
                                    <i class="bi bi-phone text-primary fs-2"></i>
                                </div>
                                <h4 class="h5 fw-bold mb-3" style="font-family: 'Georgia', serif;">Acceso Móvil</h4>
                                <p class="text-secondary-emphasis mb-0">
                                    Experiencia responsive optimizada para dispositivos móviles, 
                                    permitiendo gestión académica desde cualquier lugar y momento.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-5 bg-primary bg-gradient">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8">
                        <h2 class="display-5 fw-bold text-white mb-4" style="font-family: 'Georgia', serif;">
                            ¿Listo para transformar tu gestión académica?
                        </h2>
                        <p class="lead text-white opacity-75 mb-4">
                            Únete a instituciones educativas que ya optimizaron sus procesos con nuestra plataforma
                        </p>
                        <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4 py-3 fw-bold text-primary">
                                    <i class="bi bi-rocket-takeoff me-2"></i>
                                    Comenzar Ahora
                                </a>
                            @endif
                            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-4 py-3">
                                <i class="bi bi-calendar-check me-2"></i>
                                Agendar Demo
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer Mejorado -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-journal-bookmark-fill me-2 fs-4 text-primary"></i>
                        <span class="navbar-brand fw-bold text-white" style="font-family: 'Georgia', serif;">
                            Academic Management
                        </span>
                    </div>
                    <p class="text-white-50 mb-3">
                        Plataforma líder en gestión académica que transforma la experiencia educativa 
                        mediante la automatización y centralización de procesos institucionales.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white-50 hover-lift">
                            <i class="bi bi-twitter fs-5"></i>
                        </a>
                        <a href="#" class="text-white-50 hover-lift">
                            <i class="bi bi-facebook fs-5"></i>
                        </a>
                        <a href="#" class="text-white-50 hover-lift">
                            <i class="bi bi-linkedin fs-5"></i>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-4">
                    <h6 class="fw-bold mb-3">Plataforma</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#features" class="text-white-50 text-decoration-none hover-lift">Características</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-lift">Precios</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-lift">Demo</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-4">
                    <h6 class="fw-bold mb-3">Soporte</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-lift">Centro de Ayuda</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-lift">Contacto</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-lift">Documentación</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-4">
                    <h6 class="fw-bold mb-3">Legal</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-lift">Privacidad</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-lift">Términos</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-lift">Cookies</a></li>
                    </ul>
                </div>
            </div>
            
            <hr class="my-4 border-white-10">
            
            <div class="row align-items-center">
                <div class="col-md-6">
                    <span class="text-white-50 small">
                        © {{ date('Y') }} Academic Management. Todos los derechos reservados.
                    </span>
                </div>
                <div class="col-md-6 text-md-end">
                    <span class="text-white-50 small">
                        Hecho con <i class="bi bi-heart-fill text-danger mx-1"></i> para la educación
                    </span>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>