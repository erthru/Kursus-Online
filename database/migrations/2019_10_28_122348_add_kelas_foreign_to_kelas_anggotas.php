<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKelasForeignToKelasAnggotas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kelas_anggotas', function (Blueprint $table) {
            $table->dropForeign(['pengguna_id']);
            $table->foreign('pengguna_id')->references('id')->on('penggunas')->onDelete('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelass')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kelas_anggotas', function (Blueprint $table) {
            //
        });
    }
}
