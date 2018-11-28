<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteColumnCalculohoraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {       
        Schema::table('calculo_horas', function (Blueprint $table) {            
            $table->dropForeign('calculo_horas_idAno_foreign');            
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

            $table->unsignedInteger('idAno')->after('idEstablecimiento');
            
            $table->foreign('idAno')->references('id')->on('anos');
        });
    }
}
