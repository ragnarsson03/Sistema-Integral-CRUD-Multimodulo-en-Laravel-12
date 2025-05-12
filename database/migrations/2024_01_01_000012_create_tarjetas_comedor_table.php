<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tarjetas_comedor', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->foreignId('estudiante_id')->constrained('estudiantes');
            $table->decimal('saldo', 10, 2)->default(0);
            $table->boolean('activa')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tarjetas_comedor');
    }
};