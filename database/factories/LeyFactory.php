<?php

use Faker\Generator as Faker;

$factory->define(App\Ley::class, function (Faker $faker) {
    return [
        'codigo' 		=> '410101',
        'nombre' 		=> 'SUELDO BASE',
        'descripcion' 	=> 'SUELDO BASE',
        'tipo' 			=> 'Haber',
        'imponible' 	=> 1,
        'sueldoBase'	=> 1,
        'afp'			=> 0,
        'salud'			=> 0,
        'adicionalSalud'=> 0,
        'porcMax'		=> 90,
        'tope'			=> 0,
        'estado'		=> 1
    ];
});
