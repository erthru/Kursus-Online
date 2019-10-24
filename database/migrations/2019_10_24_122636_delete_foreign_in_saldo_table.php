<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteForeignInSaldoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengajar_saldos', function (Blueprint $table) {
            $table->dropForeign(['pengajar_id']);
            $table->dropColumn('pengajar_id');
        });

        Schema::table('siswa_saldos', function (Blueprint $table) {
            $table->dropForeign(['siswa_id']);
            $table->dropColumn('siswa_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengajar_saldos', function (Blueprint $table) {
            //
        });
    }
}
