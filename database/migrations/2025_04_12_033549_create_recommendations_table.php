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
        Schema::create('recommendations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_id')->constrained()->onDelete('cascade');
            $table->enum('type', [
                'lighting', 
                'appliance', 
                'behavior', 
                'tariff', 
                'other'
            ]);
            $table->text('description');
            $table->enum('priority', ['high', 'medium', 'low']);
            $table->boolean('implemented')->default(false);
            $table->decimal('potential_savings', 8, 2)->nullable(); // kWh/mes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recommendations');
    }
};
