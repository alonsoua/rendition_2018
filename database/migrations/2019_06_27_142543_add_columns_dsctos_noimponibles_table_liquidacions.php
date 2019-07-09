<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsDsctosNoimponiblesTableLiquidacions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('liquidacions', function (Blueprint $table) {

            $table->integer('bonoEscolaridad')->nullable()->after('asignacionFamiliar');
            $table->integer('bonoMovilizacion')->nullable()->after('bonoEscolaridad');
            $table->integer('bonoColacion')->nullable()->after('bonoMovilizacion');
            $table->integer('bonoAdicional')->nullable()->after('bonoColacion');
            $table->integer('bonoEspecial')->nullable()->after('bonoAdicional');
            $table->integer('bonoSae')->nullable()->after('bonoEspecial');
            $table->integer('bonoVacaciones')->nullable()->after('bonoSae');
            $table->integer('aguinaldoFiestasPatrias')->nullable()->after('bonoVacaciones');
            $table->integer('aguinaldoNavidad')->nullable()->after('aguinaldoFiestasPatrias');

            $table->integer('permisoSinSueldo')->nullable()->after('aguinaldoNavidad');
            $table->integer('atrasos')->nullable()->after('permisoSinSueldo');
            $table->integer('otros')->nullable()->after('prestamos');

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
            $table->dropColumn('bonoEscolaridad');
            $table->dropColumn('bonoMovilizacion');
            $table->dropColumn('bonoColacion');
            $table->dropColumn('bonoAdicional');
            $table->dropColumn('bonoEspecial');
            $table->dropColumn('bonoSae');
            $table->dropColumn('bonoVacaciones');
            $table->dropColumn('aguinaldoFiestasPatrias');
            $table->dropColumn('aguinaldoNavidad');
            $table->dropColumn('permisoSinSueldo');
            $table->dropColumn('atrasos');
            $table->dropColumn('otros');            
        });
    }
}
