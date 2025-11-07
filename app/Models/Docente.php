<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Docente extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'especialidad'];

    /**
     * Obtiene el registro de usuario base.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtiene todas las clases (asignaciones) que imparte el docente.
     */
    public function asignaciones(): HasMany
    {
        return $this->hasMany(Asignacion::class);
    }
}