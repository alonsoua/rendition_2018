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
            $table->increments('id')->;
            $table->string('rut', 20);
            $table->string('nombre', 200);
            $table->string('apellidoPaterno', 150);
            $table->string('apellidoMaterno', 150);
            
            $table->integer('idComuna')->unsigned();
            
            $table->text('direccion');
            $table->string('fono', 45)->nullable();
            $table->string('correo', 150)->nullable();
            $table->boolean('estado')->default(1);
            
            $table->timestamps();

            

            $table->foreign('idComuna')->references('id')->on('comunas');

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
