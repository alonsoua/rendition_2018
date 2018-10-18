<?php

use Faker\Generator as Faker;

$factory->define(App\Funcion::class, function (Faker $faker) {
    return [
        'codigo' 		=> 'DIR',
        'nombre' 		=> 'Director',
        'descripcion' 	=> 'Director Colegio',
        'estado' 		=> 1
    ];
});
