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
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id('idInventario'); // Primary key
            $table->string('codInventario', 50)->unique()->index(); // Unique and indexed
            $table->string('codProveedor', 50)->index(); // Index for supplier code
            $table->string('descrInventario', 255);
            $table->string('unidadInventario', 50);
            $table->decimal('precioDolarInventario', 10, 2);
            $table->decimal('precioCordInventario', 10, 2);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventarios');
    }
};



        /*Schema::create('inventarios', function (Blueprint $table) {
            $table->id('idInventario'); // Primary key
            $table->unsignedBigInteger('idLote')->index();
            $table->string('codInventario', 50)->unique()->index(); // Already unique, but index for faster lookups
            $table->string('codProveedor', 50)->index(); // Index for supplier code
            $table->string('descrInventario', 255);
            $table->string('unidadInventario', 50);
            $table->decimal('precioDolarInventario', 10, 2);
            $table->decimal('precioCordInventario', 10, 2);
            $table->integer('stockInventario');
            $table->timestamps();

            //foreing keys
            $table->foreign('idLote')->references('idLote')->on('lote_inventarios')->nullable()->onDelete('cascade');

        });*/