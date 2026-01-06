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
        Schema::table('trees', function (Blueprint $table) {
            $table->unsignedInteger('tree_name_id')->nullable()->after('type_id');
            $table->string('health_condition')->nullable()->after('planted_date');
            $table->boolean('death')->nullable()->after('health_condition');

          $table->foreign('tree_name_id')
            ->references('id')
            ->on('tree_names')
            ->onDelete('restrict')
            ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trees', function (Blueprint $table) {

            $table->dropColumn(['tree_name', 'health_condition', 'death']);
        });
    }
};
