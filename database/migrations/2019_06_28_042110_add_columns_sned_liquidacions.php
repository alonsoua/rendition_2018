<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsSnedLiquidacions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('liquidacions', function (Blueprint $table) {                    
        //     // $table->integer('sned')->nullable()->after('fechaInicioContratoSep');
        //     // $table->integer('reajusteSned')->nullable()->after('sned');         
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('liquidacions', function (Blueprint $table) {
        //     // $table->dropColumn('sned');
        //     // $table->dropColumn('reajusteSned');
                   
        // });
    }
}
