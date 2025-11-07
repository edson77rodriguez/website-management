<x-app-layout>
    <x-slot name="header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="h2 fw-bold text-dark mb-0" style="font-family: 'Georgia', serif;">
                        Editar Usuario
                    </h1>
                    <nav aria-label="breadcrumb" class="mt-2">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.usuarios.index') }}" class="text-decoration-none">Usuarios</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar {{ $user->nombre }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-outline-secondary">
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
                                <i class="bi bi-person-gear text-primary fs-4"></i>
                            </div>
                            <div>
                                <h5 class="card-title fw-bold mb-1" style="font-family: 'Georgia', serif;">
                                    Actualizar Información de Usuario
                                </h5>
                                <p class="text-muted mb-0">Editando: {{ $user->nombre }} {{ $user->apellido_paterno }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('admin.usuarios.update', $user) }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')

                            <!-- Información Personal -->
                            <div class="mb-5">
                                <h6 class="fw-bold text-primary mb-3 d-flex align-items-center">
                                    <i class="bi bi-person-badge me-2"></i>
                                    Información Personal
                                </h6>
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="nombre" class="form-label fw-semibold">
                                            Nombre(s) <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="bi bi-person text-muted"></i>
                                            </span>
                                            <input id="nombre" type="text" 
                                                   class="form-control border-start-0 ps-0 @error('nombre') is-invalid @enderror" 
                                                   name="nombre" 
                                                   value="{{ old('nombre', $user->nombre) }}" 
                                                   placeholder="Ej. María"
                                                   required 
                                                   autofocus>
                                        </div>
                                        @error('nombre')
                                            <div class="invalid-feedback d-block">
                                                <i class="bi bi-exclamation-circle me-1"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="apellido_paterno" class="form-label fw-semibold">
                                            Apellido Paterno <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="bi bi-person text-muted"></i>
                                            </span>
                                            <input id="apellido_paterno" type="text" 
                                                   class="form-control border-start-0 ps-0 @error('apellido_paterno') is-invalid @enderror" 
                                                   name="apellido_paterno" 
                                                   value="{{ old('apellido_paterno', $user->apellido_paterno) }}" 
                                                   placeholder="Ej. González"
                                                   required>
                                        </div>
                                        @error('apellido_paterno')
                                            <div class="invalid-feedback d-block">
                                                <i class="bi bi-exclamation-circle me-1"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <label for="apellido_materno" class="form-label fw-semibold">
                                        Apellido Materno 
                                        <span class="text-muted fw-normal">(Opcional)</span>
                                    </label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="bi bi-person text-muted"></i>
                                        </span>
                                        <input id="apellido_materno" type="text" 
                                               class="form-control border-start-0 ps-0 @error('apellido_materno') is-invalid @enderror" 
                                               name="apellido_materno" 
                                               value="{{ old('apellido_materno', $user->apellido_materno) }}" 
                                               placeholder="Ej. Rodríguez">
                                    </div>
                                    @error('apellido_materno')
                                        <div class="invalid-feedback d-block">
                                            <i class="bi bi-exclamation-circle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Información de Cuenta -->
                            <div class="mb-5">
                                <h6 class="fw-bold text-primary mb-3 d-flex align-items-center">
                                    <i class="bi bi-envelope me-2"></i>
                                    Información de Cuenta
                                </h6>
                                
                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <label for="email" class="form-label fw-semibold">
                                            Correo Electrónico <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="bi bi-at text-muted"></i>
                                            </span>
                                            <input id="email" type="email" 
                                                   class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror" 
                                                   name="email" 
                                                   value="{{ old('email', $user->email) }}" 
                                                   placeholder="usuario@institucion.edu"
                                                   required>
                                        </div>
                                        @error('email')
                                            <div class="invalid-feedback d-block">
                                                <i class="bi bi-exclamation-circle me-1"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="rol" class="form-label fw-semibold">
                                            Rol del Usuario <span class="text-danger">*</span>
                                        </label>
                                        <select id="rol" name="rol" 
                                                class="form-select form-select-lg @error('rol') is-invalid @enderror" 
                                                required>
                                            <option value="Estudiante" {{ old('rol', $user->rol) == 'Estudiante' ? 'selected' : '' }}>
                                                Estudiante
                                            </option>
                                            <option value="Docente" {{ old('rol', $user->rol) == 'Docente' ? 'selected' : '' }}>
                                                Docente
                                            </option>
                                            <option value="Administrador" {{ old('rol', $user->rol) == 'Administrador' ? 'selected' : '' }}>
                                                Administrador
                                            </option>
                                        </select>
                                        @error('rol')
                                            <div class="invalid-feedback d-block">
                                                <i class="bi bi-exclamation-circle me-1"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Cambio de Contraseña -->
                            <div class="mb-4">
                                <h6 class="fw-bold text-primary mb-3 d-flex align-items-center">
                                    <i class="bi bi-shield-lock me-2"></i>
                                    Seguridad
                                </h6>
                                
                                <div class="alert alert-info border-0 bg-info bg-opacity-10">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-info-circle-fill text-info me-2"></i>
                                        <div>
                                            <strong>Cambio de contraseña opcional</strong><br>
                                            <small class="text-muted">Deja los campos en blanco si no deseas cambiar la contraseña.</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3 mt-3">
                                    <div class="col-md-6">
                                        <label for="password" class="form-label fw-semibold">Nueva Contraseña</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="bi bi-key text-muted"></i>
                                            </span>
                                            <input id="password" type="password" 
                                                   class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror" 
                                                   name="password" 
                                                   placeholder="Mínimo 8 caracteres">
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

                                    <div class="col-md-6">
                                        <label for="password_confirmation" class="form-label fw-semibold">Confirmar Contraseña</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="bi bi-key-fill text-muted"></i>
                                            </span>
                                            <input id="password_confirmation" type="password" 
                                                   class="form-control border-start-0 ps-0" 
                                                   name="password_confirmation" 
                                                   placeholder="Repite la contraseña">
                                            <button class="btn btn-outline-secondary border-start-0" type="button" id="toggleConfirmPassword">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Botones de Acción -->
                            <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                                <a href="{{ route('admin.usuarios.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle me-1"></i>
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg px-4">
                                    <i class="bi bi-check-circle me-2"></i>
                                    Actualizar Usuario
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
        });
    </script>
</x-app-layout>