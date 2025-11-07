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
    Schema::create('estudiantes', function (Blueprint $table) {
        $table->id();
        // Conexión a la tabla 'users'
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->string('matricula', 20)->unique();
        
        // Conexiones a los catálogos
        $table->foreignId('semestre_id')->constrained('semestres')->onDelete('restrict');
        
        // LA CORRECCIÓN: Conexión al grupo
        $table->foreignId('grupo_id')->constrained('grupos')->onDelete('restrict');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
