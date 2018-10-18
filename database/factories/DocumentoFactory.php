<?php

use Faker\Generator as Faker;

$factory->define(App\Documento::class, function (Faker $faker) {
    return [
        'codigo' 		=> 'BOL',
        'nombre' 		=> 'BOLETA',
        'descripcion' 	=> 'Boleta Simple',
        'exento'	 	=> 0,
        'estado' 		=> 1
    ];
});
