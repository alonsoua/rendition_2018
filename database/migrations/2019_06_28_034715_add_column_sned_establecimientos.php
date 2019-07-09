<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnSnedEstablecimientos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('establecimientos', function (Blueprint $table) {
            
            $table->boolean('sned')->default(1)->comment('0 .- No - 1 .- Si')->after('correo');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('establecimientos', function (Blueprint $table) {
            $table->dropColumn('porcentaje');
        });
    }
}
