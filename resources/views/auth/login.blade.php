<x-guest-layout>
    <div class="container-fluid vh-100">
        <div class="row h-100">
            <!-- Left Side - Brand & Visual -->
            <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center bg-primary bg-gradient position-relative overflow-hidden">
                <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\"><text x=\"50%\" y=\"50%\" font-family=\"Georgia\" font-size=\"24\" text-anchor=\"middle\" dominant-baseline=\"middle\" fill=\"white\">AM</text></svg>') repeat;"></div>
                </div>
                <div class="text-center text-white position-relative z-1 px-5">
                    <i class="bi bi-journal-bookmark-fill display-1 mb-4 opacity-90"></i>
                    <h1 class="display-5 fw-bold mb-3" style="font-family: 'Georgia', serif;">
                        Academic Management
                    </h1>
                    <p class="lead opacity-90 mb-0">
                        Bienvenido de vuelta a la plataforma de gestión académica líder
                    </p>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="col-lg-6 d-flex align-items-center justify-content-center bg-light">
                <div class="w-100" style="max-width: 400px;">
                    <!-- Mobile Brand -->
                    <div class="text-center mb-5 d-lg-none">
                        <a href="/" class="text-decoration-none">
                            <i class="bi bi-journal-bookmark-fill text-primary display-4 mb-3 d-block"></i>
                            <h2 class="text-primary fw-bold" style="font-family: 'Georgia', serif;">
                                Academic Management
                            </h2>
                        </a>
                        <p class="text-muted mt-2">Inicia sesión en tu cuenta</p>
                    </div>

                    <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                        <div class="card-header bg-white py-4 border-0">
                            <h3 class="text-center text-dark fw-bold mb-0" style="font-family: 'Georgia', serif;">
                                Iniciar Sesión
                            </h3>
                        </div>
                        
                        <div class="card-body p-4 p-md-5">
                            <x-auth-session-status class="alert alert-success border-0 small mb-4" :status="session('status')" />

                            <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                                @csrf

                                <!-- Email Field -->
                                <div class="mb-4">
                                    <label for="email" class="form-label fw-semibold text-dark mb-2">
                                        <i class="bi bi-envelope-fill text-primary me-2"></i>
                                        Correo Electrónico
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
                                               placeholder="tu.correo@ejemplo.com"
                                               required 
                                               autofocus 
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
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <label for="password" class="form-label fw-semibold text-dark mb-0">
                                            <i class="bi bi-lock-fill text-primary me-2"></i>
                                            Contraseña
                                        </label>
                                        @if (Route::has('password.request'))
                                            <a class="small text-primary text-decoration-none fw-medium" href="{{ route('password.request') }}">
                                                ¿Olvidaste tu contraseña?
                                            </a>
                                        @endif
                                    </div>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="bi bi-key text-muted"></i>
                                        </span>
                                        <input id="password" 
                                               class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror"
                                               type="password" 
                                               name="password" 
                                               placeholder="Ingresa tu contraseña"
                                               required 
                                               autocomplete="current-password" />
                                        <button class="btn btn-outline-secondary border-start-0" type="button" id="togglePassword">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback d-block">
                                            <i class="bi bi-exclamation-circle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Remember Me -->
                                <div class="mb-4">
                                    <div class="form-check">
                                        <input id="remember_me" 
                                               type="checkbox" 
                                               class="form-check-input" 
                                               name="remember"
                                               {{ old('remember') ? 'checked' : '' }} />
                                        <label for="remember_me" class="form-check-label text-muted">
                                            <i class="bi bi-check2-square me-1"></i>
                                            Recordar sesión en este dispositivo
                                        </label>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="d-grid mb-4">
                                    <button type="submit" class="btn btn-primary btn-lg py-3 fw-semibold">
                                        <i class="bi bi-box-arrow-in-right me-2"></i>
                                        Iniciar Sesión
                                    </button>
                                </div>

                                <!-- Divider -->
                                <div class="text-center position-relative my-4">
                                    <hr class="text-muted">
                                    <span class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted small">
                                        ¿Primera vez aquí?
                                    </span>
                                </div>

                                <!-- Register Link -->
                                <div class="text-center">
                                    <a class="btn btn-outline-primary btn-lg w-100 py-3" href="{{ route('register') }}">
                                        <i class="bi bi-person-plus me-2"></i>
                                        Crear Cuenta Nueva
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Additional Info -->
                    <div class="text-center mt-4">
                        <p class="small text-muted mb-0">
                            <i class="bi bi-shield-check me-1"></i>
                            Tus datos están protegidos con encriptación de grado empresarial
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.getElementById('togglePassword')?.addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        });

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