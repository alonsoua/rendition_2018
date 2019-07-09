<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNoimponibleTableLeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leys', function (Blueprint $table) {                    
            $table->boolean('noImponible')->default(0)->nullable()->after('imponible');              
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
            $table->dropColumn('noImponible');
        });
    }
}
