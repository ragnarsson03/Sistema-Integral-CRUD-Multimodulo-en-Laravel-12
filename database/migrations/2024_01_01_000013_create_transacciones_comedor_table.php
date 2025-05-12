<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transacciones_comedor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tarjeta_id')->constrained('tarjetas_comedor');
            $table->enum('tipo', ['abono', 'consumo']);
            $table->decimal('monto', 10, 2);
            $table->text('descripcion')->nullable();
            $table->foreignId('operador_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transacciones_comedor');
    }
};