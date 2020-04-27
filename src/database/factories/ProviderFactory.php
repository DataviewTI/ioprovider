<?php
namespace Dataview\IOProvider;

use Dataview\IOProvider\Provider;
use Faker as Faker;

$factory->define(Provider::class, function (Faker $faker) {
    return [
      "name"=> $name,
      "cpf_cnpj" => $cpf_cnpj,
      "isWhatsapp" => $faker->boolean(75),
      "delivery" => $faker->boolean,
      "phone"=> $faker->cellphoneNumber,
      "email"=> $faker->email,
      "instagram" => $faker->boolean(33) ? $faker->lexify('????????') : null,
      "description" => text(mt_rand(20,400)),
      "status"=>"A"
    ];
});

// $factory->afterCreating(Provider::class::class, function ($provider, $faker) {
//     // $provider->categories->assoc
// });
