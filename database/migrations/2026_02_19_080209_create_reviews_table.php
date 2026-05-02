<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('reviews');

        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('id_siswa');
            $table->integer('rating');
            $table->text('comment');
            $table->timestamps();
        });

       
        try {
            Schema::table('reviews', function (Blueprint $table) {
                $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
                $table->foreign('id_siswa')->references('id_siswa')->on('siswa')->onDelete('cascade');
            });
        } catch (\Exception $e) {
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};