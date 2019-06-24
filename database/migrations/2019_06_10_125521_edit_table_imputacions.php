<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditTableImputacions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imputacions', function (Blueprint $table) {
            
            $table->enum('tipo', ['Gasto', 'Honorario'])                    
                    ->comment('Gasto', 'Honorario')
                    ->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imputacions', function (Blueprint $table) {
            $table->dropColumn('tipo');                    
        });
    }
}
