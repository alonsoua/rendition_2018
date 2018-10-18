<?php

use Faker\Generator as Faker;

$factory->define(App\Establecimiento::class, function (Faker $faker) {
    return [
        'nombre' 		=> 'Colegio Los Heroes',
        'rbd' 			=> '16569',
        'razonSocial' 	=> 'Corporacion Educacional Un nimo un sueno de sarmiento',
        'rut' 			=> '651478413',

        //'idComuna' 		=> rand(1,2),
        'direccion' 	=> 'Av. Arturo Prat 256, Sarmiento',
        'fono' 			=> '975307317',
        'correo' 		=> '',
        'estado' 		=> 1
    ];
});