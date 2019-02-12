<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCuentaDocumento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('cuenta_documento', function (Blueprint $table) {
            $table->increments('id');            

            $table->integer('idCuenta')->unsigned();
            $table->integer('idDocumento')->unsigned();            

            $table->foreign('idCuenta')->references('id')->on('cuentas');
            $table->foreign('idDocumento')->references('id')->on('documentos');
            
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
        Schema::dropIfExists('cuenta_documento');
    }
}
