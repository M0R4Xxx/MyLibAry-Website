<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('fine_logs', function (Blueprint $table) {
            // Kita gunakan default 'Pay Off' agar data lama yang sudah ada otomatis dianggap lunas
            $table->string('payment_status')->default('Pay Off')->after('calculated_at');
        });
    }

    public function down()
    {
        Schema::table('fine_logs', function (Blueprint $table) {
            $table->dropColumn('payment_status');
        });
    }
};