<?php

use Faker\Generator as Faker;

$factory->define(App\Cuenta::class, function (Faker $faker) {
    return [
        'codigo' 		=> '410304',
        'nombre' 		=> 'Cuenta',
        'descripcion' 	=> 'Cuenta',
        'estado' 		=> 1
    ];
});