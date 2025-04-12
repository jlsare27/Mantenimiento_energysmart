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
        Schema::create('lightings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_id')->constrained()->onDelete('cascade');
            $table->enum('type', [
                'incandescente', 
                'halogena', 
                'fluorescente', 
                'LED', 
                'otra'
            ]);
            $table->decimal('power', 6, 2); // potencia por unidad en W
            $table->integer('quantity');
            $table->decimal('hours_use', 5, 2); // horas diarias de uso
            $table->string('location')->nullable(); // sala, cocina, etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lightings');
    }
};
