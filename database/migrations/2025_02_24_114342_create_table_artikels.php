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
        Schema::create('artikels', function (Blueprint $table) {
            $table->id('idArtikel');
            $table->unsignedBigInteger('idKategori');
            $table->unsignedBigInteger('idUser');
            $table->string('judul');
            $table->text('deskripsi')->nullable()->default('text');
            $table->string('gambar');
            $table->timestamps();

            $table->foreign('idUser')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('idKategori')
                ->references('idKategori')
                ->on('kategoris')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikels');
    }
};