<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up(): void
{
    Schema::create('calificaciones', function (Blueprint $table) {
        $table->id();

        // Conexión con el Estudiante
        $table->foreignId('estudiante_id')->constrained('estudiantes')->onDelete('cascade');

        // Conexión con la Clase
        $table->foreignId('asignacion_id')->constrained('asignaciones')->onDelete('cascade');
        $table->Integer('numero_unidad') ->nullable();
        // La calificación
        $table->decimal('calificacion', 5, 2)->nullable(); // Ej: 100.00 o 9.50

        // Evita que un estudiante tenga dos calificaciones para la misma clase
        $table->unique(['estudiante_id', 'asignacion_id', 'numero_unidad']);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calificaciones');
    }
};
