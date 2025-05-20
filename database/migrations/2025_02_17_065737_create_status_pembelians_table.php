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
        Schema::create('status_pembelians', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('telepon');
            $table->string('alamat');
            $table->unsignedBigInteger('bunga_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('jumlah');
            $table->decimal('total_harga', 10, 2);
            $table->string('metode_pembayaran')->nullable();
            $table->dateTime('tanggal');
            $table->string('status')->default('pending');
            $table->string('order_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('bunga_id')->references('id')->on('bungas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_pembelians');
    }
};
