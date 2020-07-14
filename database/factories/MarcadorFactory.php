<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Marcador;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Marcador::class, function (Faker $faker) {
    return [
        'titulo_marcador' => $faker->name,
        'descripcion_marcador' => $faker->text(100),
        'latitud_marcador' => $faker->latitude(-34.40000, -34.61315),
        'longitud_marcador' => $faker->longitude(-58.37723, -58.646495),
    ];
});
