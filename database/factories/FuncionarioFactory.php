<?php

use Faker\Generator as Faker;

$factory->define(App\Funcionario::class, function (Faker $faker) {
    return [
        'rut' => '333333333',
        'nombre' => 'Prueba',
        'apellidoPaterno' => 'Prueba',
        'apellidoMaterno' => 'Prueba',
        'horasCtoSemanal' => '23',
        'fechaInicioContrato' => '2018-01-12',
        'fechaTerminoContrato' => '2018-09-12',
        'ufIsapre' => '3.4000',
        'estado' => 1
    ];
});
