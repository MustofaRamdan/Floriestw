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
        Schema::create('pembeli', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('telepon');
            $table->string('alamat');
            $table->unsignedBigInteger('bunga_id'); // Tambahkan kolom bunga_id
            $table->integer('jumlah');
            $table->decimal('total_harga', 10, 2);
            $table->timestamps();

            $table->foreign('bunga_id')->references('id')->on('bungas')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelis');
    }
};
