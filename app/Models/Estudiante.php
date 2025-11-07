<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estudiante extends Model
{
    use HasFactory;

    // Aquí incluimos la corrección (grupo_id)
    protected $fillable = ['user_id', 'matricula', 'semestre_id', 'grupo_id'];

    /**
     * Obtiene el registro de usuario base.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtiene el semestre al que pertenece el estudiante.
     */
    public function semestre(): BelongsTo
    {
        return $this->belongsTo(Semestre::class);
    }

    /**
     * Obtiene el grupo al que pertenece el estudiante.
     */
    public function grupo(): BelongsTo
    {
        return $this->belongsTo(Grupo::class);
    }

    /**
     * Obtiene todo el historial de asistencias del estudiante.
     */
    public function asistencias(): HasMany
    {
        return $this->hasMany(Asistencia::class);
    }
    public function calificaciones(): HasMany
{
    return $this->hasMany(Calificacion::class);
}
}