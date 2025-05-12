<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('autor');
            $table->string('isbn')->unique();
            $table->string('editorial')->nullable();
            $table->year('anio_publicacion')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('categoria')->nullable();
            $table->integer('ejemplares_totales')->default(1);
            $table->integer('ejemplares_disponibles')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('libros');
    }
};