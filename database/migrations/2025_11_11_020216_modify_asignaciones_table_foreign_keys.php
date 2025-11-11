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
        Schema::table('asignaciones', function (Blueprint $table) {
            // Primero eliminamos las restricciones existentes
            $table->dropForeign(['docente_id']);
            $table->dropForeign(['grupo_id']);
            $table->dropForeign(['materia_id']);
            
            // Luego creamos las nuevas con onDelete('cascade')
            $table->foreign('docente_id')
                  ->references('id')
                  ->on('docentes')
                  ->onDelete('cascade');
            
            $table->foreign('grupo_id')
                  ->references('id')
                  ->on('grupos')
                  ->onDelete('cascade');
            
            $table->foreign('materia_id')
                  ->references('id')
                  ->on('materias')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('asignaciones', function (Blueprint $table) {
            // Revertir a las restricciones anteriores
            $table->dropForeign(['docente_id']);
            $table->dropForeign(['grupo_id']);
            $table->dropForeign(['materia_id']);
            
            $table->foreign('docente_id')
                  ->references('id')
                  ->on('docentes')
                  ->onDelete('restrict');
            
            $table->foreign('grupo_id')
                  ->references('id')
                  ->on('grupos')
                  ->onDelete('restrict');
            
            $table->foreign('materia_id')
                  ->references('id')
                  ->on('materias')
                  ->onDelete('restrict');
        });
    }
};
