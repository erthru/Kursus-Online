<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteSiswasTableAndMakeUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kelas_anggotas', function(Blueprint $table) {
            $table->dropForeign(['siswa_id']);
        });

        Schema::drop('siswas');
        Schema::rename('pengajars','pengguna');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
