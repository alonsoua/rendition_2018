<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeNameColumnLeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leys', function (Blueprint $table) {            
            $table->renameColumn('porcMax', 'porcentajeMax');
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
            $table->renameColumn('porcentajeMax', 'porcMax');
        });
    }
}
