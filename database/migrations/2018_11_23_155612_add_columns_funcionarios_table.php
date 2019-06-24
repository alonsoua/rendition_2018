<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('funcionarios', function (Blueprint $table) {

            // $table->unsignedInteger('idAfp')->after('apellidoMaterno');
            // $table->unsignedInteger('idSalud')->after('idAfp');            

            // $table->foreign('idAfp')->references('id')->on('afp');
            // $table->foreign('idSalud')->references('id')->on('salud');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('funcionarios', function (Blueprint $table) {
            // $table->dropForeign('funcionarios_idAfp_foreign');
            // $table->dropForeign('funcionarios_idSalud_foreign');    
        });
    }
}
