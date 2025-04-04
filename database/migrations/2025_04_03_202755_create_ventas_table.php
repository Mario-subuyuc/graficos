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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id') // Relación con el usuario que hizo la venta
                  ->constrained('users') // Se asegura que se refiere a la tabla 'users'
                  ->onDelete('cascade'); // Si el usuario es eliminado, también se elimina la venta
            $table->date('fecha')->default(now());
            $table->decimal('total', 10, 2);
            $table->enum('articulo', ['Articulo1', 'Articulo2', 'Articulo3', 'Articulo4', 'Articulo5']);
            $table->integer('cantidad');
            $table->enum('metodo_pago', ['Efectivo', 'Tarjeta', 'Transferencia', 'Otro']);
            $table->enum('cliente', ['Cliente1', 'Cliente2', 'Cliente3', 'Cliente4', 'Otro']);
            $table->timestamps();
        });
    }
        

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
