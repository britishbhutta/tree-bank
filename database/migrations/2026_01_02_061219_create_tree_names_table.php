<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tree_names', function (Blueprint $table) {
            $table->integer('id')->unsigned()->autoIncrement();

            $table->unsignedInteger('tree_type_id');
            $table->string('name');
            $table->text('description')->nullable();

            $table->timestamps();

            $table->foreign('tree_type_id')
                  ->references('id')
                  ->on('tree_types')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tree_names');
    }
};

