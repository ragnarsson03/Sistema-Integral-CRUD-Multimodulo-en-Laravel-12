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
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estudiante_id')->constrained()->onDelete('cascade');
            $table->string('asignatura');
            $table->decimal('calificacion', 5, 2);
            $table->string('periodo');
            $table->date('fecha_evaluacion');
            $table->text('observaciones')->nullable();
            $table->timestamps();
            
            // Índice para búsquedas rápidas
            $table->index(['estudiante_id', 'asignatura', 'periodo']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};