<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsCalculoHoraDetalle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        //
        Schema::table('calculo_hora_detalle', function (Blueprint $table) {

            $table->unsignedInteger('idCalculoHora')->after('id');
            $table->unsignedInteger('idLey')->after('idCalculoHora');            
            
            $table->integer('cargaPeriodo')->nullable()->after('idLey');
            $table->integer('cantHoras')->nullable()->after('cargaPeriodo');
            $table->integer('valor')->nullable()->after('cantHoras');

            $table->foreign('idCalculoHora')->references('id')->on('calculo_horas');
            $table->foreign('idLey')->references('id')->on('leys');
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
            $table->dropForeign('calculo_hora_detalle_idCalculoHora_foreign');
            $table->dropForeign('calculo_hora_detalle_idLey_foreign');        
            
            $table->dropColumn('cargaPeriodo');
            $table->dropColumn('cantHoras');
            $table->dropColumn('valor');    
        });
    }
}
