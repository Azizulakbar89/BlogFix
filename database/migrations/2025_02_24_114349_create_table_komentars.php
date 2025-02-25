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
        Schema::create('komentars', function (Blueprint $table) {
            $table->id('idKomentar');
            $table->unsignedBigInteger('idUser');
            $table->unsignedBigInteger('idArtikel');
            $table->text('komentar')->nullable()->default('text');
            $table->integer('rating')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('idUser')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('idArtikel')
                ->references('idArtikel')
                ->on('artikels')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komentars');
    }
};