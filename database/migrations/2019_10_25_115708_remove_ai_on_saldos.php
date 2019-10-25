<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveAiOnSaldos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengajar_saldos', function (Blueprint $table) {
            $table->unsignedInteger('id')->change();
        });

        Schema::table('siswa_saldos', function (Blueprint $table) {
            $table->unsignedInteger('id')->change();
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
