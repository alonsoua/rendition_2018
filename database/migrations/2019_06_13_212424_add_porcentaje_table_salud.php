<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPorcentajeTableSalud extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salud', function (Blueprint $table) {

            $table->integer('porcentaje')->nullable()->after('nombre');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salud', function (Blueprint $table) {
            $table->dropColumn('porcentaje');
        });
    }
}
