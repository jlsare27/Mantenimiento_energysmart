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
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('home_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->decimal('target_consumption', 10, 2); // kWh/mes
            $table->date('target_date');
            $table->decimal('current_consumption', 10, 2)->nullable();
            $table->enum('status', ['active', 'achieved', 'failed'])->default('active');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goals');
    }
};
