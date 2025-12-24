<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
    Schema::table('photos', function (Blueprint $table) {
    $table->unsignedInteger('ws_id')->nullable()->after('tree_id');

    $table->foreign('ws_id')
          ->references('id')
          ->on('work_shops')
          ->onDelete('cascade');
    });
    }

    public function down(): void
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->dropForeign(['ws_id']);
            $table->dropColumn('ws_id');
        });
    }
};
