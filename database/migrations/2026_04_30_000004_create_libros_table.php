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
            $table->string('ISBN', 20)->unique();
            $table->decimal('precio', 10, 2);
            $table->integer('stock')->default(0);
            $table->string('idioma');
            $table->string('imagen_portada', 255)->nullable();
            $table->date('fecha_registro');
            $table->boolean('activo')->default(true);
            $table->foreignId('id_autor')->constrained('autores')->restrictOnDelete();
            $table->foreignId('id_categoria')->constrained('categorias')->restrictOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('libros');
    }
};
