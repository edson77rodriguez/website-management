<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// AÑADE LAS RELACIONES
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // ACTUALIZA ESTA PROPIEDAD
    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'email',
        'password',
        'rol', // <-- Añadido
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // --- AÑADE ESTAS RELACIONES Y FUNCIONES ---

    /**
     * Obtiene el perfil de docente asociado al usuario.
     */
    public function docente(): HasOne
    {
        return $this->hasOne(Docente::class);
    }

    /**
     * Obtiene el perfil de estudiante asociado al usuario.
     */
    public function estudiante(): HasOne
    {
        return $this->hasOne(Estudiante::class);
    }

    // --- HELPERS DE ROL ---
    public function isAdministrador(): bool
    {
        return $this->rol === 'Administrador';
    }

    public function isDocente(): bool
    {
        return $this->rol === 'Docente';
    }

    public function isEstudiante(): bool
    {
        return $this->rol === 'Estudiante';
    }
}