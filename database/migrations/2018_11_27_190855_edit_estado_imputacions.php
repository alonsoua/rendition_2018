<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditEstadoImputacions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('imputacions', function (Blueprint $table) {

        //     // $table->dropColumn('estado');
        //     $table->enum('estado', ['Por Aprobar', 'Aprobado', 'Rechazado'])
        //             ->nullable()
        //             ->comment('Por Aprobar - Aprobado - Rechazado')
        //             ->after('documento');

        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('imputacions', function (Blueprint $table) {
        //     $table->dropColumn('estado');                    
        // });
    }
}
