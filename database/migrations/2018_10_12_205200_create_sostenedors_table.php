<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSostenedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sostenedors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rut', 20)->nullable();
            $table->string('nombre', 200)->nullable();
            $table->string('apellidoPaterno', 150)->nullable();
            $table->string('apellidoMaterno', 150)->nullable();
            
            //$table->integer('idComuna')->unsigned()->nullable();
            
            $table->text('direccion')->nullable();
            $table->string('fono', 45)->nullable();
            $table->string('correo', 150)->nullable();
            $table->boolean('estado')->default(1)->comment('0 .- Inactivo - 1 .- Activo');
            
            $table->timestamps();

            

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
        Schema::dropIfExists('sostenedors');
    }
}
