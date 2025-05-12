<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Doctrine\DBAL\Types\Type;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Verificar si la columna 'dni' existe antes de intentar renombrarla
        if (Schema::hasColumn('pacientes', 'dni')) {
            Schema::table('pacientes', function (Blueprint $table) {
                $table->renameColumn('dni', 'cedula');
            });
        }
        // Si la columna 'dni' no existe pero la tabla sí, y no existe 'cedula', crear la columna
        else if (Schema::hasTable('pacientes') && !Schema::hasColumn('pacientes', 'cedula')) {
            Schema::table('pacientes', function (Blueprint $table) {
                $table->string('cedula')->unique()->after('fecha_nacimiento');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('pacientes', 'cedula')) {
            Schema::table('pacientes', function (Blueprint $table) {
                $table->renameColumn('cedula', 'dni');
            });
        }
    }
};
