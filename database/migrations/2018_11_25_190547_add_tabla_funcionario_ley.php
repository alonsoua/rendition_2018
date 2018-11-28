<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTablaFuncionarioLey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionario_ley', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('idFuncionario');
            $table->unsignedInteger('idLey');
            $table->unsignedInteger('idSubvencion');
            
            $table->integer('horas')->nullable();

            $table->boolean('estado')->default(1)->comment('0 .- Inactivo - 1 .- Activo');

            $table->foreign('idFuncionario')->references('id')->on('funcionarios');
            $table->foreign('idLey')->references('id')->on('leys');
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
        $table->dropForeign('funcionario_ley_idFuncionario_foreign');
        $table->dropForeign('funcionario_ley_idLey_foreign');
        $table->dropForeign('funcionario_ley_idSubvencion_foreign');

        Schema::dropIfExists('funcionario_ley');
    }
}
