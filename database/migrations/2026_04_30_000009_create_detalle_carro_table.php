<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalle_carro', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_carrito')->constrained('carros')->cascadeOnDelete();
            $table->foreignId('id_libro')->constrained('libros')->restrictOnDelete();
            $table->integer('cantidad')->default(1);
            $table->decimal('precio_unitario', 10, 2);
            $table->unique(['id_carrito', 'id_libro']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_carro');
    }
};
