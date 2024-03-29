<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailMobilsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_mobils', function (Blueprint $table) {
             $table->uuid('id')->primary();
            $table->uuid('mobil_id');
            $table->string('plat',12);
            $table->string('stnk');
            $table->string('tahun_mobil');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('detail_mobils', function (Blueprint $table) {
            $table->foreign('mobil_id')->references('id')->on('mobils')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('detail_mobils');
    }
}
