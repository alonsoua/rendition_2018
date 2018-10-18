<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->increments('id');

            //$table->integer('idEstablecimiento')->unsigned();
            $table->string('rut', 14)->nullable();
            $table->string('nombre', 100)->nullable();
            $table->string('apellidoPaterno', 100)->nullable();
            $table->string('apellidoMaterno', 100)->nullable();

            //$table->integer('idTipoContrato')->unsigned();

            $table->integer('horasCtoSemanal')->nullable();            
            $table->date('fechaInicioContrato')->nullable();
            $table->date('fechaTerminoContrato')->nullable();

            //$table->integer('idFuncion')->unsigned()->nullable();            
            //$table->integer('idAfp')->unsigned()->nullable();            
            //$table->integer('idSalud')->unsigned()->nullable();            
            
            $table->double('ufIsapre', 5, 4);

            $table->boolean('estado')->default(1)->comment('0 .- Inactivo - 1 .- Activo');

            $table->timestamps();

            //$table->foreign('idEstablecimiento')->references('id')->on('establecimientos');
            //$table->foreign('idTipoContrato')->references('id')->on('tipo_contrato');
            //$table->foreign('idFuncion')->references('id')->on('funcions');
            //$table->foreign('idAfp')->references('id')->on('afp');
            //$table->foreign('idSalud')->references('id')->on('salud');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funcionarios');
    }
}
