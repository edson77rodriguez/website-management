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
    Schema::create('asignaciones', function (Blueprint $table) {
        $table->id();
        $table->foreignId('docente_id')->constrained('docentes')->onDelete('restrict');
        $table->foreignId('grupo_id')->constrained('grupos')->onDelete('restrict');
        $table->foreignId('materia_id')->constrained('materias')->onDelete('restrict');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignaciones');
    }
};
