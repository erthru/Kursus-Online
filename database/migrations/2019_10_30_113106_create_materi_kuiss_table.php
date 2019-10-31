<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMateriKuissTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materi_kuiss', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pertanyaan');
            $table->longText('jawaban');
            $table->unsignedBigInteger('materi_id');
            $table->timestamps();
        });

        Schema::table('materi_kuiss', function (Blueprint $table){
            $table->foreign('materi_id')->references('id')->on('materis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materi_kuiss');
    }
}
