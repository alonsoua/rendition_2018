<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsAsignacionPrestamosTablaLiquidacions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('liquidacions', function (Blueprint $table) {

            $table->integer('asignacionFamiliar')->nullable()->after('fechaInicioContratoSep');
            $table->integer('prestamos')->nullable()->after('asignacionFamiliar');

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
            $table->dropColumn('asignacionFamiliar');
            $table->dropColumn('prestamos');
        });
    }
}
