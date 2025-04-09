<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('homes', function (Blueprint $table) {
            $table->id();
            // Relación con el usuario que registra el hogar
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Información global
            $table->string('location'); // Dirección o región
            $table->text('general_characteristics')->nullable(); // Características generales
            $table->string('connection_type'); // Tipo de conexión (por ejemplo: monofásica, trifásica)
            // Campo opcional para tarifa manual o referencia a tarifa automática
            $table->foreignId('tariff_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homes');
    }
}
