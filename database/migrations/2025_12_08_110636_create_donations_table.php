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
        Schema::create('donations', function (Blueprint $table) {
            $table->integer('id')->unsigned()->autoIncrement();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('ws_id')->nullable();
            $table->string('type')->nullable()->comment('Trees/Funds');
            $table->string('amount')->nullable()->comment('Numbers/Money');
            $table->string('fund_type')->nullable()->comment('Cash/Cheque etc .Null If Tress are in donation');
            $table->string('flow')->nullable()->comment('Donation Taken / Given');
            $table->string('donation_number')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ws_id')->references('id')->on('work_shops')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
