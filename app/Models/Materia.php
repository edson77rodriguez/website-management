<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Materia extends Model
{
    use HasFactory;

protected $fillable = [
    'nombre_materia',
    'numero_unidades', // <-- AÑADE ESTO
    'clave_materia'
];
    /**
     * Obtiene todas las asignaciones (clases) de esta materia.
     */
    public function asignaciones(): HasMany
    {
        return $this->hasMany(Asignacion::class);
    }
}