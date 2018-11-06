<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeingKeyLeyes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leys', function (Blueprint $table) {
            $table->unsignedInteger('idSubvencion')->after('nombre');

            $table->foreign('idSubvencion')->references('id')->on('subvencions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leys', function (Blueprint $table) {     
            $table->dropForeign('subvencion_idSubvencion_foreign');
        });
    }
}
