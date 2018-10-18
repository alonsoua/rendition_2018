<?php

use Faker\Generator as Faker;

$factory->define(App\Proveedor::class, function (Faker $faker) {
    return [
        'tipoPersona' => 'Persona Jurídica',
        'rut' => '995384701',
        'razonSocial' => 'PORTALES DE NEGOCIOS S.A.',
        'giro' => 'a',
        'direccion' => 'prueba',
        'fono' => '1',
        'correo' => 'prueba@gmail.com',
        'estado' => 1

    ];
});