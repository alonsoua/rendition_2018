<?php

use Faker\Generator as Faker;

$factory->define(App\Subvencion::class, function (Faker $faker) {
    return [
        'codigo' 		=> 'NOSUB',
        'nombre' 		=> 'GENERAL',
        'descripcion' 	=> 'GENERAL',
        'valorHora' 	=> 6500,
        'porcentajeMax' => 80,
        'descripcion' 	=> 1
    ];
});
