<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiquidacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liquidacions', function (Blueprint $table) {
            $table->increments('id');

            //$table->integer('idEstablecimiento')->unsigned();
            //$table->integer('idFuncionario')->unsigned();
            //$table->integer('idPeriodo')->unsigned();
            
            $table->date('fechaLiquidacion')->nullable();
            $table->integer('diasTrabajados')->nullable();
            $table->integer('horasContratoSep')->nullable();
            $table->string('fechaInicioContratoSep',45)->nullable();
            $table->boolean('estado')->default(1)->comment('0 .- Inactivo - 1 .- Activo');
            
            $table->timestamps();

            //$table->foreign('idEstablecimiento')->references('id')->on('establecimientos');
            //$table->foreign('idFuncionario')->references('id')->on('funcionarios');
            //$table->foreign('idPeriodo')->references('id')->on('periodos');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('liquidacions');
    }
}
