<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produk_titipans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_produk');
            $table->string('nama_supplier');
            $table->double('harga_beli');
            $table->double('harga_jual');
            $table->integer('stok');
            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_titipans');
    }
};
