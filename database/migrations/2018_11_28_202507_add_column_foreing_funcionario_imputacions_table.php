<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnForeingFuncionarioImputacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imputacions', function (Blueprint $table) {
            
            $table->boolean('reembolsable')->nullable()->after('idEstablecimiento');
            $table->unsignedInteger('idFuncionario')->nullable()->after('idEstablecimiento');       
            $table->foreign('idFuncionario')->references('id')->on('funcionarios');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imputacions', function (Blueprint $table) {                   
            $table->dropColumn('reembolsabl');
            $table->dropForeign('imputacions_idFuncionario_foreign');
        });
    }
}
