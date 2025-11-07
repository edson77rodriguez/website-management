<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Asistencia extends Model
{
    use HasFactory;

    protected $fillable = ['estudiante_id', 'asignacion_id', 'fecha', 'estado'];

    /**
     * The attributes that should be cast.
     * (Para que Laravel trate la 'fecha' como un objeto Carbon)
     *
     * @var array
     */
    protected $casts = [
        'fecha' => 'date',
    ];

    /**
     * Obtiene el estudiante de este registro de asistencia.
     */
    public function estudiante(): BelongsTo
    {
        return $this->belongsTo(Estudiante::class);
    }

    /**
     * Obtiene la clase (asignacion) de este registro.
     */
    public function asignacion(): BelongsTo
    {
        return $this->belongsTo(Asignacion::class);
    }
}