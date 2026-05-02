<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('user_fine_balances', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->unique(); // ID User Anda
            $table->decimal('total_fine', 12, 2)->default(0); // Saldo denda yang harus dibayar
            $table->timestamps();
        });

        Schema::create('fine_logs', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->unsignedBigInteger('loan_id')->nullable();
            $table->string('book_title'); 
            $table->decimal('final_fine_amount', 12, 2); 
            $table->timestamp('calculated_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fine_logs');
        Schema::dropIfExists('user_fine_balances');
    }
};
