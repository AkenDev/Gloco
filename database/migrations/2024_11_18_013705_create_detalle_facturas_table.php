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
        Schema::create('detalle_facturas', function (Blueprint $table) {
            $table->id('idDetalle'); // Primary key
            $table->unsignedBigInteger('idFactura')->index(); // Index for the foreign key
            $table->string('codInventario', 50)->index(); // Add index for inventory code
            $table->integer('cantidad');
            $table->decimal('precioUnitario', 10, 2);
            $table->decimal('ivaUnitario', 10, 2);
            $table->timestamps();
        
            // Foreign key constraints
            $table->foreign('idFactura')->references('idFactura')->on('facturas')->onDelete('cascade');
            $table->foreign('codInventario')->references('codInventario')->on('inventarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_facturas');
    }
};
