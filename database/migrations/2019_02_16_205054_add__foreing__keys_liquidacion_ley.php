<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeingKeysLiquidacionLey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('liquidacion_ley', function (Blueprint $table) {

            
            $table->unsignedInteger('idLey')->after('id')->default(1);
            $table->unsignedInteger('idLiquidacion')->after('idLey')->default(1);

            $table->foreign('idLey')->references('id')->on('leys');
            $table->foreign('idLiquidacion')->references('id')->on('liquidacions');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('liquidacion_ley', function (Blueprint $table) {       
            $table->dropForeign('liquidacion_ley_idLey_foreign');
            $table->dropForeign('liquidacion_ley_idLiquidacion_foreign');
        });
    }
}
