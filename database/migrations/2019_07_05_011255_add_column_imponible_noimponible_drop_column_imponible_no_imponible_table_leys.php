<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnImponibleNoimponibleDropColumnImponibleNoImponibleTableLeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('leys', function (Blueprint $table) {

            $table->enum('haber', ['Imponible', 'No Imponible'])->nullable()->comment('Imponible - No Imponible')->after('tipo');
            $table->enum('descuento', ['Descuento Legal', 'Otro Descuento'])->nullable()->comment('Descuento Legal - Otro Descuento')->after('haber');
            
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
            $table->dropColumn('haber');
            $table->dropColumn('descuento');
        });
    }
}
