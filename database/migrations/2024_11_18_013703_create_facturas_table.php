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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id('idFactura'); // Primary key
            $table->unsignedBigInteger('idCliente'); // Foreign key column
            $table->date('fecha')->index(); // Add index for quick searches
            $table->boolean('esDolar');
            $table->decimal('totalSubtotal', 10, 2);
            $table->decimal('ivaAplicado', 10, 2);
            $table->date('fechaVence')->index(); // Add index for filtering by due date
            $table->string('tipoFactura', 50);
            $table->timestamps();
        
            // Foreign key constraints
            $table->foreign('idCliente')->references('idCliente')->on('clientes')->onDelete('cascade')->index();
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
