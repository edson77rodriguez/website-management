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
        Schema::table('materias', function (Blueprint $table) {
        // Añadimos la nueva columna después de 'nombre_materia'
        // Por defecto, 1 unidad, no puede ser 0.
        $table->unsignedInteger('numero_unidades')->default(1)->after('nombre_materia');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materias', function (Blueprint $table) {
        $table->dropColumn('numero_unidades');
    });
    }
};
