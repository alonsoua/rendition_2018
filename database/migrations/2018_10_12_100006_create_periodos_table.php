<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodos', function (Blueprint $table) {
            $table->increments('id');

            //$table->integer('idAno')->unsigned()->nullable();
            
            $table->string('periodo')->nullable();
            $table->boolean('estado')->default(1)->comment('0 .- Inactivo - 1 .- Activo');
            $table->timestamps();

            //$table->foreign('idAno')->references('id')->on('anos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('periodos');
    }
}
