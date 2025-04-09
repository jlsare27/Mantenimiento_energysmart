<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppliancesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appliances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_id')->constrained()->onDelete('cascade');
            $table->string('name');    // Nombre del electrodoméstico
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('category')->nullable(); // Por ejemplo: Refrigerador, Lavadora, etc.
            $table->integer('nominal_power'); // Potencia nominal en Watts
            $table->decimal('daily_usage_hours', 4, 2); // Horas de uso diarias
            $table->string('energy_efficiency_label')->nullable(); // Etiqueta de eficiencia
            $table->year('acquisition_year')->nullable(); // Año de adquisición
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
}
