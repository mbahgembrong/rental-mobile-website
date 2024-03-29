<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobilsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobils', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('kategori_id');
            $table->string('nama');
            $table->string('jenis');
            $table->string('merk');
            $table->integer('harga');
            $table->string('satuan');
            $table->integer('denda');
            $table->string('foto');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('mobils', function (Blueprint $table) {
            $table->foreign('kategori_id')->references('id')->on('kategori_mobils')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mobils');
    }
}
