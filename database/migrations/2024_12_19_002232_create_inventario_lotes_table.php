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
        Schema::create('inventario_lotes', function (Blueprint $table) {
            $table->id(); // Primary key for the pivot table
            $table->unsignedBigInteger('idInventario')->index(); // Foreign key to Inventarios
            $table->unsignedBigInteger('idLote')->index(); // Foreign key to LoteInventarios
            $table->integer('stockPorLote'); // Stock for this specific lote
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('idInventario')->references('idInventario')->on('inventarios')->onDelete('cascade');
            $table->foreign('idLote')->references('idLote')->on('lote_inventarios')->onDelete('cascade');

            // Indexes for faster lookups
            $table->index(['idInventario', 'idLote']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventario_lotes');
    }
};
