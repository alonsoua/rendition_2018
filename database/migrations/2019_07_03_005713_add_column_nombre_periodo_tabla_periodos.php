<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnNombrePeriodoTablaPeriodos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('periodos', function (Blueprint $table) {                    
            $table->string('nombrePeriodo', 20)->after('periodo');                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('periodos', function (Blueprint $table) {
            $table->dropColumn('nombrePeriodo');
        });
    }
}
