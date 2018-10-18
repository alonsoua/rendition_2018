<?php

use Faker\Generator as Faker;

$factory->define(App\Liquidacion::class, function (Faker $faker) {
    return [
        'fechaLiquidacion' => '2017-09-04',
        'diasTrabajados' => 30,
        'horasContratoSep' => 12,
        'fechaInicioContratoSep' => '23-04-2017',
        'estado' => 1
    ];
});
