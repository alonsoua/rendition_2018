<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubvencionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subvencions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo', 10)->nullable();
            $table->string('nombre', 100)->nullable();
            $table->text('descripcion')->nullable();
            $table->integer('valorHora')->default(0);
            $table->integer('porcentajeMax')->default(0);

            $table->boolean('estado')->default(1)->comment('0 .- Inactivo - 1 .- Activo');            
            
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
        Schema::dropIfExists('subvencions');
    }
}
