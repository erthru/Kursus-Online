<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiswaSaldosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa_saldos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('saldo');
            $table->unsignedBigInteger('siswa_id');
            $table->timestamps();
        });

        Schema::table('siswa_saldos', function (Blueprint $table){
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa_saldos');
    }
}
