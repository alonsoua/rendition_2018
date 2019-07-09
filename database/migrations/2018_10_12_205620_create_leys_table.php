<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo', 40)->nullable();
            $table->string('nombre', 100)->nullable();
            

            //$table->integer('idSubvencion')->unsigned()->nullable();

            $table->text('descripcion')->nullable();
            $table->enum('tipo', ['Haber', 'Descuento'])->nullable()->comment('Haber - Descuento');
            
            $table->boolean('sueldoBase')->default(0)->nullable();
            $table->boolean('afp')->default(0)->nullable();
            $table->boolean('salud')->default(0)->nullable();
            $table->boolean('adicionalSalud')->default(0)->nullable();

            $table->integer('porcMax')->default(0)->nullable();
            $table->integer('tope')->default(0)->nullable();

            $table->boolean('estado')->default(1)->comment('0 .- Inactivo - 1 .- Activo');

            $table->timestamps();

            //$table->foreign('idSubvencion')->references('id')->on('subvencions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leys');
    }
}
