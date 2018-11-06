<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeingKeyFuncionarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('funcionarios', function (Blueprint $table) {
            $table->unsignedInteger('idEstablecimiento')->after('id');
            $table->unsignedInteger('idTipoContrato')->after('apellidoMaterno');
            $table->unsignedInteger('idFuncion')->after('fechaTerminoContrato');

            $table->foreign('idEstablecimiento')->references('id')->on('establecimientos');
            $table->foreign('idTipoContrato')->references('id')->on('tipo_contrato');
            $table->foreign('idFuncion')->references('id')->on('funcions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('funcionarios', function (Blueprint $table) {       
            $table->dropForeign('funcionarios_idEstablecimiento_foreign');
            $table->dropForeign('funcionarios_idTipoContrato_foreign');
            $table->dropForeign('funcionarios_idFuncion_foreign');
        });
    }
}
