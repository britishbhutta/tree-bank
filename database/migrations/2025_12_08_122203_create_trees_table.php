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
        Schema::create('trees', function (Blueprint $table) {
            $table->integer('id')->unsigned()->autoIncrement();
            $table->unsignedInteger('donation_id')->nullable()->comment('Donation In');
            $table->unsignedInteger('donation_id_out')->nullable()->comment('Donation Out');
            $table->unsignedInteger('type_id')->nullable();
            $table->unsignedInteger('user_id')->nullable()->comment('Planted By');
            $table->unsignedInteger('user_id_ct')->nullable()->comment('Care Taken By');
            $table->unsignedInteger('project_id')->nullable();
            $table->string('age')->nullable()->comment('At the time of Donation');
            $table->string('bought_date')->nullable()->comment('Null If tree Donated');
            $table->string('planting_status')->nullable();
            $table->string('location')->nullable()->comment('Where Planted');
            $table->string('planted_date')->nullable();
            $table->string('last_visited_date')->nullable()->comment('By Care Taker');
            $table->string('visit_req')->nullable()->comment('By Days');
            $table->string('notes')->nullable();
            $table->string('purpose')->nullable();
            $table->timestamps();
            $table->foreign('donation_id')->references('id')->on('donations')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('donation_id_out')->references('id')->on('donations')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('type_id')->references('id')->on('tree_types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('user_id_ct')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trees');
    }
};
