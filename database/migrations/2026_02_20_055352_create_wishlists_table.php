<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('wishlists');

        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('siswa_id')->index();
            $table->unsignedBigInteger('book_id')->index();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wishlists');
    }
};