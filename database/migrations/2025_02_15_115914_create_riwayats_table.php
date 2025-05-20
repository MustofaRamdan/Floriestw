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
        Schema::create('riwayat', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('telepon');
            $table->string('alamat');
            $table->unsignedBigInteger('bunga_id');
            $table->unsignedBigInteger('user_id'); // Tambahkan kolom user_id
            $table->integer('jumlah');
            $table->decimal('total_harga', 10, 2);
            $table->dateTime('tanggal');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Tambahkan foreign key
            $table->foreign('bunga_id')->references('id')->on('bungas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat');

    }
};
