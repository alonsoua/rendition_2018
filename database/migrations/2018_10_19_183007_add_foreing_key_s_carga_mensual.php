<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeingKeySCargaMensual extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carga_mensuals', function (Blueprint $table) {

            $table->unsignedInteger('idPeriodo')->after('id');
            $table->unsignedInteger('idEstablecimiento')->after('idPeriodo');

            $table->foreign('idPeriodo')->references('id')->on('periodos');
            $table->foreign('idEstablecimiento')->references('id')->on('establecimientos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carga_mensuals', function (Blueprint $table) {       
            $table->dropForeign('carga_mensuals_idPeriodo_foreign');
            $table->dropForeign('carga_mensuals_idEstablecimiento_foreign');
        });
    }
}
