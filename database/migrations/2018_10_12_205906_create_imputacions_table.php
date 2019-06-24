<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImputacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imputacions', function (Blueprint $table) {
            $table->increments('id');
            //$table->integer('idEstablecimiento')->unsigned();
            //$table->integer('idSubvencion')->unsigned();
            //$table->integer('idCuenta')->unsigned();
            //$table->integer('idDocumento')->unsigned();
            
            $table->integer('numDocumento')->nullable();
            $table->date('fechaDocumento')->nullable();
            $table->date('fechaPago')->nullable();

            $table->text('descripcion')->nullable();

            //$table->integer('idProveedor')->unsigned();
            
            $table->integer('montoGasto')->nullable();
            $table->integer('montoDocumento')->nullable();
            
            $table->text('documento')->nullable();            

            // $table->boolean('estado')->default(1)->comment('0 .- Inactivo - 1 .- Activo');
             $table->enum('estado', ['Por Aprobar', 'Aprobado', 'Rechazado'])
                    ->nullable()
                    ->comment('Por Aprobar - Aprobado - Rechazado')
                    ->after('documento');
            $table->timestamps();

            //$table->foreign('idEstablecimiento')->references('id')->on('establecimientos');
            //$table->foreign('idSubvencion')->references('id')->on('subvencions');
            //$table->foreign('idCuenta')->references('id')->on('cuentas');
            //$table->foreign('idDocumento')->references('id')->on('documentos');
            //$table->foreign('idProveedor')->references('id')->on('proveedors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imputacions');
    }
}
