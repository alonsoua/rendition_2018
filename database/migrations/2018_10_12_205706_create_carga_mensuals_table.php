<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargaMensualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carga_mensuals', function (Blueprint $table) {
            $table->increments('id');

            //$table->integer('idPeriodo')->unsigned()->nullable();
            //$table->integer('idEstablecimiento')->unsigned()->nullable();

            $table->boolean('estado')->default(1)->comment('0 .- Inactivo - 1 .- Activo');

            $table->timestamps();

            //$table->foreign('idPeriodo')->references('id')->on('periodos');
            //$table->foreign('idEstablecimiento')->references('id')->on('subvencions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carga_mensuals');
    }
}
