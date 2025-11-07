<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Asignacion extends Model
{
    protected $table = 'asignaciones'; // <-- AÑADE ESTA LÍNEA
    use HasFactory;

    protected $fillable = ['docente_id', 'grupo_id', 'materia_id'];

    /**
     * Obtiene el docente que imparte esta clase.
     */
    public function docente(): BelongsTo
    {
        return $this->belongsTo(Docente::class);
    }

    /**
     * Obtiene el grupo que toma esta clase.
     */
    public function grupo(): BelongsTo
    {
        return $this->belongsTo(Grupo::class);
    }

    /**
     * Obtiene la materia de esta clase.
     */
    public function materia(): BelongsTo
    {
        return $this->belongsTo(Materia::class);
    }

    /**
     * Obtiene todos los registros de asistencia de esta clase.
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