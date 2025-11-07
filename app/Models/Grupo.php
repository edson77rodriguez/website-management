<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grupo extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_grupo', 'turno'];

    /**
     * Obtiene todos los estudiantes inscritos en este grupo.
     */
    public function estudiantes(): HasMany
    {
        return $this->hasMany(Estudiante::class);
    }

    /**
     * Obtiene todas las asignaciones (clases) de este grupo.
     */
    public function asignaciones(): HasMany
    {
        return $this->hasMany(Asignacion::class);
    }
}