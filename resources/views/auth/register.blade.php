<x-guest-layout>
    <div class="container-fluid vh-100">
        <div class="row h-100">
            <!-- Left Side - Brand & Visual -->
            <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center bg-primary bg-gradient position-relative overflow-hidden">
                <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\"><text x=\"50%\" y=\"50%\" font-family=\"Georgia\" font-size=\"24\" text-anchor=\"middle\" dominant-baseline=\"middle\" fill=\"white\">AM</text></svg>') repeat;"></div>
                </div>
                <div class="text-center text-white position-relative z-1 px-5">
                    <i class="bi bi-person-plus display-1 mb-4 opacity-90"></i>
                    <h1 class="display-5 fw-bold mb-3" style="font-family: 'Georgia', serif;">
                        Únete a Nosotros
                    </h1>
                    <p class="lead opacity-90 mb-4">
                        Comienza tu journey en la plataforma de gestión académica más completa
                    </p>
                    <div class="d-flex justify-content-center gap-4 text-start">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-2 opacity-75"></i>
                            <small>Fácil configuración</small>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-2 opacity-75"></i>
                            <small>Sin tarjetas</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Register Form -->
            <div class="col-lg-6 d-flex align-items-center justify-content-center bg-light">
                <div class="w-100" style="max-width: 450px;">
                    <!-- Mobile Brand -->
                    <div class="text-center mb-5 d-lg-none">
                        <a href="/" class="text-decoration-none">
                            <i class="bi bi-journal-bookmark-fill text-primary display-4 mb-3 d-block"></i>
                            <h2 class="text-primary fw-bold" style="font-family: 'Georgia', serif;">
                                Academic Management
                            </h2>
                        </a>
                        <p class="text-muted mt-2">Crea tu cuenta gratuita</p>
                    </div>

                    <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                        <div class="card-header bg-white py-4 border-0">
                            <h3 class="text-center text-dark fw-bold mb-0" style="font-family: 'Georgia', serif;">
                                Crear Cuenta
                            </h3>
                            <p class="text-center text-muted mb-0 mt-2 small">
                                Completa tus datos para comenzar
                            </p>
                        </div>
                        
                        <div class="card-body p-4 p-md-5">
                            <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                                @csrf

                                <!-- Name Fields -->
                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label for="nombre" class="form-label fw-semibold text-dark mb-2">
                                            <i class="bi bi-person-fill text-primary me-2"></i>
                                            Nombre(s) *
                                        </label>
                                        <input id="nombre" 
                                               class="form-control form-control-lg @error('nombre') is-invalid @enderror" 
                                               type="text" 
                                               name="nombre" 
                                               value="{{ old('nombre') }}" 
                                               placeholder="Ej. María"
                                               required 
                                               autofocus 
                                               autocomplete="given-name" />
                                        @error('nombre') 
                                            <div class="invalid-feedback d-block">
                                                <i class="bi bi-exclamation-circle me-1"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="apellido_paterno" class="form-label fw-semibold text-dark mb-2">
                                            Apellido Paterno *
                                        </label>
                                        <input id="apellido_paterno" 
                                               class="form-control form-control-lg @error('apellido_paterno') is-invalid @enderror" 
                                               type="text" 
                                               name="apellido_paterno" 
                                               value="{{ old('apellido_paterno') }}" 
                                               placeholder="Ej. González"
                                               required 
                                               autocomplete="family-name" />
                                        @error('apellido_paterno') 
                                            <div class="invalid-feedback d-block">
                                                <i class="bi bi-exclamation-circle me-1"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Optional Last Name -->
                                <div class="mb-4">
                                    <label for="apellido_materno" class="form-label fw-semibold text-dark mb-2">
                                        Apellido Materno 
                                        <span class="text-muted fw-normal">(Opcional)</span>
                                    </label>
                                    <input id="apellido_materno" 
                                           class="form-control form-control-lg @error('apellido_materno') is-invalid @enderror" 
                                           type="text" 
                                           name="apellido_materno" 
                                           value="{{ old('apellido_materno') }}" 
                                           placeholder="Ej. Rodríguez"
                                           autocomplete="additional-name" />
                                    @error('apellido_materno') 
                                        <div class="invalid-feedback d-block">
                                            <i class="bi bi-exclamation-circle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Email Field -->
                                <div class="mb-4">
                                    <label for="email" class="form-label fw-semibold text-dark mb-2">
                                        <i class="bi bi-envelope-fill text-primary me-2"></i>
                                        Correo Electrónico *
                                    </label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="bi bi-at text-muted"></i>
                                        </span>
                                        <input id="email" 
                                               class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror" 
                                               type="email" 
                                               name="email" 
                                               value="{{ old('email') }}" 
                                               placeholder="tu.correo@institucion.edu"
                                               required 
                                               autocomplete="username" />
                                    </div>
                                    @error('email') 
                                        <div class="invalid-feedback d-block">
                                            <i class="bi bi-exclamation-circle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Password Field -->
                                <div class="mb-4">
                                    <label for="password" class="form-label fw-semibold text-dark mb-2">
                                        <i class="bi bi-lock-fill text-primary me-2"></i>
                                        Contraseña *
                                    </label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="bi bi-key text-muted"></i>
                                        </span>
                                        <input id="password" 
                                               class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror"
                                               type="password" 
                                               name="password" 
                                               placeholder="Mínimo 8 caracteres"
                                               required 
                                               autocomplete="new-password" />
                                        <button class="btn btn-outline-secondary border-start-0" type="button" id="togglePassword">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    <div class="form-text">
                                        <i class="bi bi-info-circle me-1"></i>
                                        La contraseña debe tener al menos 8 caracteres
                                    </div>
                                    @error('password') 
                                        <div class="invalid-feedback d-block">
                                            <i class="bi bi-exclamation-circle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label fw-semibold text-dark mb-2">
                                        <i class="bi bi-lock-fill text-primary me-2"></i>
                                        Confirmar Contraseña *
                                    </label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="bi bi-key-fill text-muted"></i>
                                        </span>
                                        <input id="password_confirmation" 
                                               class="form-control border-start-0 ps-0"
                                               type="password" 
                                               name="password_confirmation" 
                                               placeholder="Repite tu contraseña"
                                               required 
                                               autocomplete="new-password" />
                                        <button class="btn btn-outline-secondary border-start-0" type="button" id="toggleConfirmPassword">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Terms Agreement -->
                                <div class="mb-4">
                                    <div class="form-check">
                                        <input id="terms_agreement" 
                                               type="checkbox" 
                                               class="form-check-input" 
                                               required />
                                        <label for="terms_agreement" class="form-check-label small text-muted">
                                            Acepto los 
                                            <a href="#" class="text-primary text-decoration-none">términos de servicio</a> 
                                            y la 
                                            <a href="#" class="text-primary text-decoration-none">política de privacidad</a>
                                        </label>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="d-grid mb-4">
                                    <button type="submit" class="btn btn-primary btn-lg py-3 fw-semibold">
                                        <i class="bi bi-person-plus me-2"></i>
                                        Crear Cuenta
                                    </button>
                                </div>

                                <!-- Divider -->
                                <div class="text-center position-relative my-4">
                                    <hr class="text-muted">
                                    <span class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted small">
                                        ¿Ya tienes cuenta?
                                    </span>
                                </div>

                                <!-- Login Link -->
                                <div class="text-center">
                                    <a class="btn btn-outline-primary btn-lg w-100 py-3" href="{{ route('login') }}">
                                        <i class="bi bi-box-arrow-in-right me-2"></i>
                                        Iniciar Sesión
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Security Note -->
                    <div class="text-center mt-4">
                        <p class="small text-muted mb-0">
                            <i class="bi bi-shield-check me-1"></i>
                            Protegemos tus datos con los más altos estándares de seguridad
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function setupPasswordToggle(inputId, buttonId) {
            const button = document.getElementById(buttonId);
            const input = document.getElementById(inputId);
            
            if (button && input) {
                button.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.replace('bi-eye', 'bi-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.replace('bi-eye-slash', 'bi-eye');
                    }
                });
            }
        }

        setupPasswordToggle('password', 'togglePassword');
        setupPasswordToggle('password_confirmation', 'toggleConfirmPassword');

        // Form validation
        document.querySelector('.needs-validation')?.addEventListener('submit', function(event) {
            if (!this.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            this.classList.add('was-validated');
        }, false);
    </script>
</x-guest-layout>