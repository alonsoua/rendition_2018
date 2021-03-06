<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoDependenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_dependencia', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nombre', 50);
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
        Schema::dropIfExists('tipo_dependencia');
    }
}
