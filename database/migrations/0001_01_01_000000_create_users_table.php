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
        Schema::create('users', function (Blueprint $table) {
        $table->integer('id')->unsigned()->autoIncrement();
        $table->string('name');
        
        // Personal info
        $table->string('email')->nullable()->unique();
        $table->string('phone')->nullable();
        $table->string('address')->nullable();
        
        // Company info
        $table->string('company_email')->nullable()->unique();
        $table->string('company_phone')->nullable();
        $table->string('company_address')->nullable();
        
        $table->tinyInteger('role')->nullable()->comment('1=User,2=Company');
        
        $table->tinyInteger('is_active')->default(1)->comment('1 = Active, 2 = Inactive');
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->rememberToken();
        $table->timestamps();
    });


        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
