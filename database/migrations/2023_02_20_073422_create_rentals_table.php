<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentalsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pelanggan_id');
            $table->uuid('detail_mobil_id');
            $table->uuid('sopir_id')->nullable();
            $table->integer('waktu_peminjaman');
            $table->integer('waktu_mulai');
            $table->integer('waktu_selesai');
            $table->integer('waktu_denda');
            $table->integer('total');
            $table->integer('denda');
            $table->integer('grand_total');
            $table->string('jenis_transaksi')->default('offline');
            $table->string('status')->default('pemesanan');
            $table->string('status_pembayaran')->default('belum');
            $table->string('keterangan')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('rentals', function (Blueprint $table) {
            $table->foreign('pelanggan_id')->references('id')->on('pelanggans')->onDelete('cascade');
            $table->foreign('detail_mobil_id')->references('id')->on('detail_mobils')->onDelete('cascade');
            $table->foreign('sopir_id')->references('id')->on('sopirs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rentals');
    }
}
