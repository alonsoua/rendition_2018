<?php

use Faker\Generator as Faker;

$factory->define(App\Sostenedor::class, function (Faker $faker) {
    return [
        'rut' 				=> rand(8, 9),
        'nombre' 			=> $faker->name,
        'apellidoPaterno' 	=> 'Apellido Paterno',
        'apellidoMaterno' 	=> 'Apellido Materno',

        'idComuna' 		=> rand(1,2),
        'direccion' 	=> $faker->address,
        'fono' 			=> rand(8,9),
        'correo' 		=> $faker->unique()->safeEmail,
        'estado' 		=> 1
    ];
});