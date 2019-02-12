<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnFormaPagoImputacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('imputacions', function (Blueprint $table) {

            $table->unsignedInteger('idFormaPago')->after('idTipoDocumento');                    

            $table->foreign('idFormaPago')->references('id')->on('forma_pago');

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
            $table->dropForeign('imputacions_idFormaPago_foreign');            
        });
    }
}
