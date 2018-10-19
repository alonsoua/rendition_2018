<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeingKeySSostenedorsIdComuna extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sostenedors', function (Blueprint $table) {

            $table->unsignedInteger('idComuna')->after('apellidoMaterno')->default(1);

            $table->foreign('idComuna')->references('id')->on('comunas');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sostenedors', function (Blueprint $table) {       
            $table->dropForeign('sostenedors_idComuna_foreign');
        });
    }
}
