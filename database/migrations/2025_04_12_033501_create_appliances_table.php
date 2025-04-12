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
        Schema::create('appliances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->enum('category', [
                'refrigeracion', 
                'cocina', 
                'lavado', 
                'entretenimiento', 
                'computo', 
                'otros'
            ]);
            $table->decimal('power', 8, 2); // en vatios (W)
            $table->decimal('hours_use', 5, 2); // horas diarias de uso
            $table->integer('quantity')->default(1);
            $table->enum('energy_efficiency', ['A+++', 'A++', 'A+', 'A', 'B', 'C', 'D', 'E', 'F', 'G'])->nullable();
            $table->integer('year_acquired')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appliances');
    }
};
