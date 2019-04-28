<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLiquidacionLey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('liquidacion_ley', function (Blueprint $table) {
            $table->increments('id');
           
            $table->integer('horasContratoLey')->nullable();
            $table->integer('valor')->nullable();
            $table->integer('valorDescuento')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('liquidacion_ley');
    }
}
