<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUniqueToPengajarAndSiswaTelp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengajars', function (Blueprint $table) {
            $table->string('telp')->unique()->change();
        });

        Schema::table('siswas', function (Blueprint $table) {
            $table->string('telp')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengajar_and_siswa_telp', function (Blueprint $table) {
            //
        });
    }
}
