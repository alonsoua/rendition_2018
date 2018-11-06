<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeingKeyImputaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imputacions', function (Blueprint $table) {
            // $table->unsignedInteger('idEstablecimiento')->after('id');
            // $table->unsignedInteger('idSubvencion')->after('idEstablecimiento');
            // $table->unsignedInteger('idCuenta')->after('idSubvencion');
            $table->unsignedInteger('idTipoDocumento')->after('idCuenta');
            $table->unsignedInteger('idProveedor')->after('descripcion');

            // $table->foreign('idEstablecimiento')->references('id')->on('establecimientos');
            // $table->foreign('idSubvencion')->references('id')->on('subvencions');
            // $table->foreign('idCuenta')->references('id')->on('cuentas');
            $table->foreign('idTipoDocumento')->references('id')->on('documentos');
            $table->foreign('idProveedor')->references('id')->on('proveedors');
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
            // $table->dropForeign('imputacions_idEstablecimiento_foreign');
            // $table->dropForeign('imputacions_idSubvencion_foreign');
            // $table->dropForeign('imputacions_idCuenta_foreign');
            $table->dropForeign('imputacions_idTipoDocumento_foreign');
            $table->dropForeign('imputacions_idProveedor_foreign');
        });
    }
}
