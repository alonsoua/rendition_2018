<?php

use Faker\Generator as Faker;

$factory->define(App\Imputacion::class, function (Faker $faker) {
    return [
        'numDocumento' => '10101010',
        'fechaDocumento' => '2018-06-14',
        'fechaPago' => '2018-06-14',
        'descripcion' => 'Imputacion de Prueba',
        'montoGasto' => '20000',
        'montoDocumento' => '20000',
        'estado' => 1
    ];
});