<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPembayaranRentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pembayaran_rentals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('rental_id');
            $table->integer('jumlah');
            $table->integer('kurang')->default(0);
            $table->string('bukti')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('detail_pembayaran_rentals', function (Blueprint $table) {
            $table->foreign('rental_id')->references('id')->on('rentals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pembayaran_rentals');
    }
}