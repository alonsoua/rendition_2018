<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableCuentaSubvencion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('cuenta_subvencion', function (Blueprint $table) {
            $table->increments('id');            

            $table->integer('idCuenta')->unsigned();
            $table->integer('idSubvencion')->unsigned();            

            $table->foreign('idCuenta')->references('id')->on('cuentas');
            $table->foreign('idSubvencion')->references('id')->on('subvencions');
            
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
        Schema::dropIfExists('cuenta_subvencion');
    }
}
