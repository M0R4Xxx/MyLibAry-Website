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
        Schema::table('user_fine_balances', function (Blueprint $table) {
            $table->bigInteger('total_overdue_seconds')->default(0)->after('total_fine'); 
            $table->integer('total_overdue_books')->default(0)->after('total_overdue_seconds');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_fine_balances', function (Blueprint $table) {
            $table->dropColumn(['total_overdue_seconds', 'total_overdue_books']);
        });
    }
};