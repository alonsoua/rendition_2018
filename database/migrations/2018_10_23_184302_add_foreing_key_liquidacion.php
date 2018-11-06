<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeingKeyLiquidacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('liquidacions', function (Blueprint $table) {
            $table->unsignedInteger('idEstablecimiento')->after('id');
            $table->unsignedInteger('idFuncionario')->after('idEstablecimiento');
            $table->unsignedInteger('idPeriodo')->after('idFuncionario');
            

            $table->foreign('idEstablecimiento')->references('id')->on('establecimientos');
            $table->foreign('idFuncionario')->references('id')->on('funcionarios');
            $table->foreign('idPeriodo')->references('id')->on('periodos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('liquidacions', function (Blueprint $table) {       
            $table->dropForeign('imputacions_idEstablecimiento_foreign');
            $table->dropForeign('imputacions_idFuncionario_foreign');
            $table->dropForeign('imputacions_idPeriodo_foreign');
        });
    }
}
