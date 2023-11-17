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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->string('license_plate');
            $table->enum('status', ['available', 'unavailable'])->default('available');
            $table->enum('ownership', ['rent', 'own'])->default('own');
            $table->enum('load_type', ['person', 'item'])->default('person');
            $table->integer('fuel_capacity')->nullable();
            $table->date('service_schedule')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
