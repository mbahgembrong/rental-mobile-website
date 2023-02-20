<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSopirsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sopirs', function (Blueprint $table) {
            $table->string('nik',12);
            $table->string('nomor_sim',12);
            $table->string('nama');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('hp',15);
            $table->string('ktp');
            $table->string('sim');
            $table->string('email');
            $table->string('password');
            $table->string('foto');
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
        Schema::drop('sopirs');
    }
}
