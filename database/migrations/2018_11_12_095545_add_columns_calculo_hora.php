<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsCalculoHora extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calculo_horas', function (Blueprint $table) {

            $table->unsignedInteger('idEstablecimiento')->after('id');
            $table->unsignedInteger('idAno')->after('idEstablecimiento');
            $table->unsignedInteger('idPeriodo')->after('idAno');
            
            $table->boolean('estado')->default(1)->nullable();

            $table->foreign('idEstablecimiento')->references('id')->on('establecimientos');
            $table->foreign('idAno')->references('id')->on('anos');
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
        Schema::table('calculo_horas', function (Blueprint $table) {
            $table->dropForeign('calculo_horas_idEstablecimiento_foreign');
            $table->dropForeign('calculo_horas_idAno_foreign');
            $table->dropForeign('calculo_horas_idPeriodo_foreign');
        });
    }
}
