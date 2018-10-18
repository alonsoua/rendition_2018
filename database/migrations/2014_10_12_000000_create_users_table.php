<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('rut', 20)->unique();
            $table->string('name', 200)->nullable();
            $table->string('apellidoPaterno', 150)->nullable();
            $table->string('apellidoMaterno', 150)->nullable();
            $table->text('direccion')->nullable();
            $table->string('email', 150)->unique();
            $table->string('password', 700);
            $table->boolean('estado')->default(1)->comment('0 .- Inactivo - 1 .- Activo');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
