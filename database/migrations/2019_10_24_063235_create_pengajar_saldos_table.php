<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengajarSaldosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajar_saldos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('saldo');
            $table->unsignedBigInteger('pengajar_id');
            $table->timestamps();
        });

        Schema::table('pengajar_saldos', function (Blueprint $table){
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
        Schema::dropIfExists('pengajar_saldos');
    }
}
