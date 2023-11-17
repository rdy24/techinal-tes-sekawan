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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mine_id')->constrained('mines')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('driver_id')->constrained('drivers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade')->onUpdate('cascade');
            $table->date('start_date');
            $table->date('return_date');
            $table->foreignId('approver_1')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('approver_2')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('approved_1_by')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('approved_2_by')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamp('approved_1_at')->nullable();
            $table->timestamp('approved_2_at')->nullable();

            $table->foreignId('created_by')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('rejected_by')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamp('rejected_at')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
