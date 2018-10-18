<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo',5)->nullable();
            $table->enum('tipoPersona', ['Persona Jurídica','Persona Natural'])->nullable()->comment('Juridica - Natural');
            $table->string('rut', 14)->nullable();
            $table->string('razonSocial',100)->nullable();
            $table->string('giro', 45)->nullable();

            //$table->integer('idComuna')->unsigned()->nullable();

            $table->text('direccion')->nullable();
            $table->string('fono', 20)->nullable();
            $table->string('correo', 200)->nullable();
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
        Schema::dropIfExists('proveedors');
    }
}
