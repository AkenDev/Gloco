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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('idCliente'); // Primary key
            $table->string('codigoCliente', 50)->unique()->index(); // Index for client code
            $table->string('depaCliente', 100)->index(); // Index for department
            $table->string('nombreCliente', 255);
            $table->string('contactoCliente', 255);
            $table->string('telCliente', 20);
            $table->string('rucCliente', 50)->unique()->index(); // Index for RUC
            $table->string('dirCliente', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
