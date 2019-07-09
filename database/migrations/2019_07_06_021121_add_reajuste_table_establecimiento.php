<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReajusteTableEstablecimiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('establecimientos', function (Blueprint $table) {

            $table->boolean('reajuste')->default(0)->nullable()->after('sned');      
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
            $table->dropColumn('reajuste');
        });
    }
}
