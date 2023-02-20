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
            $table->uuid('sopir_id');
            $table->integer('waktu_peminjaman');
            $table->integer('waktu_mulai');
            $table->integer('waktu_selesai');
            $table->integer('waktu_denda');
            $table->integer('total');
            $table->integer('denda');
            $table->integer('grand_total');
            $table->softDeletes();
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
