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
        Schema::create('crop_yields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farm_id')->constrained();
            $table->decimal('yield_liters', 10, 2); // in liters
            $table->decimal('yield_sacas', 10, 2); // in sacas
            $table->decimal('selling_price', 10, 2); // in R$ per saca
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crop_yields');
    }
};
