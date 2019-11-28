<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPenggunaForeignToKelasAnggotasAndKelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('kelas_anggotas');
        
        Schema::create('kelas_anggotas', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('pengguna_id');
            $table->timestamps();
            $table->foreign('pengguna_id')->references('id')->on('penggunas');
        });

        Schema::table('kelass', function (Blueprint $table) {
            $table->dropForeign(['pengajar_id']);
            $table->dropColumn('pengajar_id');
            $table->unsignedBigInteger('pengguna_id')->after('total_klik');
            $table->foreign('pengguna_id')->references('id')->on('penggunas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kelas_anggotas_and_kelas', function (Blueprint $table) {
            //
        });
    }
}
