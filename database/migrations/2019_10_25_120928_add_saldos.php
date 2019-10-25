<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSaldos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengajars', function (Blueprint $table) {
            $table->bigInteger('saldo')->after('telp');
        });

        Schema::table('siswas', function (Blueprint $table) {
            $table->bigInteger('saldo')->after('telp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengajars', function (Blueprint $table) {
            //
        });
    }
}
