<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('jumlah_pelanggan');
            $table->string('nama_pemesan');
            $table->dateTime('hari_pesan');
            $table->enum('status', ['di_proses', 'selesai']);
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('table_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
