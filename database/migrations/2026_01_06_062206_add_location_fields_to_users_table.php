<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('city')->nullable()->after('role');
            $table->string('tehsil')->nullable()->after('city');
            $table->string('district')->nullable()->after('tehsil');
            $table->string('department')->nullable()->after('district');

            $table->string('company_city')->nullable()->after('department');
            $table->string('company_district')->nullable()->after('company_city');
            $table->string('company_tehsil')->nullable()->after('company_district');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'city',
                'tehsil',
                'district',
                'department',
                'company_city',
                'company_district',
                'company_tehsil',
            ]);
        });
    }
};
