<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeingKeyPeriodosIdAno extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('periodos', function (Blueprint $table) {
       
            $table->unsignedInteger('idAno')->after('id');

            $table->foreign('idAno')->references('id')->on('anos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('periodos', function (Blueprint $table) {       
            $table->dropForeign('periodos_idAno_foreign');
        });
    }
}
