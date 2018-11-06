<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeingKeysEstablecimientos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('establecimientos', function (Blueprint $table) {

            $table->unsignedInteger('idTipoDependencia')->after('rut');
            $table->unsignedInteger('idSostenedor')->after('idTipoDependencia');
            $table->unsignedInteger('idComuna')->after('idSostenedor');

            $table->foreign('idTipoDependencia')->references('id')->on('tipo_dependencia');
            $table->foreign('idSostenedor')->references('id')->on('sostenedors');
            $table->foreign('idComuna')->references('id')->on('comunas');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('establecimientos', function (Blueprint $table) {       
            $table->dropForeign('establecimientos_idTipoDependencia_foreign');
            $table->dropForeign('establecimientos_idSostenedor_foreign');
            $table->dropForeign('establecimientos_idComuna_foreign');
        });
    }
}
