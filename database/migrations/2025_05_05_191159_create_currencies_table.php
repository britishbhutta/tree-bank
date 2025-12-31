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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('symbol', 6)->nullable();
            $table->string('code', 10)->unique();
            $table->float('rate')->default(1);
            $table->tinyInteger('decimals')->default(2);
            $table->enum('symbol_placement', ['before', 'after'])->default('before');
            $table->tinyInteger('primary_order')->default(0);
            $table->enum('is_default', ['Yes', 'No'])->default('No');
            $table->enum('is_active', ['Yes', 'No'])->default('Yes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
