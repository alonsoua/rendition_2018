<?php

use Faker\Generator as Faker;

$factory->define(App\Establecimiento::class, function (Faker $faker) {
    return [
        'nombre' 		     => 'Los Heroes',
        'rbd' 			     => '16569',
        'razonSocial' 	     => 'Corporacion Educacional Un nimo un sueno de sarmiento',
        'rut' 			     => '782354413',
        'idTipoDependencia'  => 2,
        'idSostenedor'       => 4,
        'idComuna' 		     => 13,
        'direccion' 	     => 'Av. Arturo Prat 256, Sarmiento',
        'fono' 			     => '975307317',
        'correo' 		     => 'correo@prueba.cl',
        'estado' 		     => 1
    ];
});