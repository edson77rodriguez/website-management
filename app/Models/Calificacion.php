<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Calificacion extends Model
{
    use HasFactory;

    // Le decimos a Laravel que el plural es 'calificaciones'
    protected $table = 'calificaciones';

    protected $fillable = [
    'estudiante_id',
    'asignacion_id',
    'numero_unidad', // <-- AÑADE ESTO
    'calificacion',
];

    // Relación: Una calificación pertenece a un Estudiante
    public function estudiante(): BelongsTo
    {
        return $this->belongsTo(Estudiante::class);
    }

    // Relación: Una calificación pertenece a una Asignación (clase)
    public function asignacion(): BelongsTo
    {
        return $this->belongsTo(Asignacion::class);
    }
}