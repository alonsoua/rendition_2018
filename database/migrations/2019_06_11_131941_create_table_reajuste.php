<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReajuste extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reajustes', function (Blueprint $table) {
            $table->increments('id');            

            $table->integer('idAno')->unsigned();
            $table->integer('porcentajeReajuste');            

            $table->foreign('idAno')->references('id')->on('anos');            
            
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
        Schema::dropIfExists('reajustes');
    }
}
