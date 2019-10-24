<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKelassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelass', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->longText('deskripsi');
            $table->integer('harga');
            $table->unsignedBigInteger('pengajar_id');
            $table->timestamps();
        });

        Schema::table('kelass', function (Blueprint $table) {
            $table->foreign('pengajar_id')->references('id')->on('pengajars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelass');
    }
}
