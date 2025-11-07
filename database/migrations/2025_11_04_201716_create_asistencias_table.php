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
    Schema::create('asistencias', function (Blueprint $table) {
        $table->id();
        $table->foreignId('estudiante_id')->constrained('estudiantes')->onDelete('cascade');
        $table->foreignId('asignacion_id')->constrained('asignaciones')->onDelete('cascade');
        $table->date('fecha');
        $table->enum('estado', ['Presente', 'Ausente', 'Retardo', 'Justificado']);
        
        // Para evitar duplicados: un estudiante, una clase, una fecha
        $table->unique(['estudiante_id', 'asignacion_id', 'fecha'], 'asistencia_unica');
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
