<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstablecimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('establecimientos', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nombre', 200)->nullable();
            $table->string('rbd', 20)->nullable();
            $table->string('razonSocial',200)->nullable();
            $table->string('rut', 45)->nullable();
            
            //$table->integer('idTipoDependencia')->unsigned()->nullable();
            //$table->integer('idSostenedor')->unsigned()->nullable();
            //$table->integer('idComuna')->unsigned()->nullable();
            
            $table->text('direccion')->nullable();
            $table->string('fono', 45)->nullable();
            $table->string('correo', 200)->nullable();
            $table->longText('insignia')->nullable();
            $table->boolean('estado')->default(1)->comment('0 .- Inactivo - 1 .- Activo');
            
            $table->timestamps();

            //$table->foreign('idTipoDependencia')->references('id')->on('comunas');
            
            //$table->foreign('idSostenedor')->references('id')->on('sostenedores');
            //$table->foreign('idComuna')->references('id')->on('comunas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('establecimientos');
    }
}
