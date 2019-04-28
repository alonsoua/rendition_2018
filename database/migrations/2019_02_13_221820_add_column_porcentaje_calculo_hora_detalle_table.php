<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnPorcentajeCalculoHoraDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calculo_hora_detalle', function (Blueprint $table) {

            $table->integer('porcentaje')->nullable()->after('idLey');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calculo_hora_detalle', function (Blueprint $table) {
            $table->dropColumn('porcentaje');
        });
    }
}
