<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddonRentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addon_rentals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('rental_id');
            $table->string('keterangan');
            $table->float('jumlah')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('addon_rentals', function (Blueprint $table) {
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
        Schema::dropIfExists('addon_rentals');
    }
}