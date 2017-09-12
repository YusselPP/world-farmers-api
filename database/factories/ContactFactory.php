<?php

use Faker\Generator as Faker;

$factory->define(App\Contact::class, function (Faker $faker) {

    return [
        'name' => $faker->name,
        'phoneNumber' => $faker->phoneNumber,
        'products' => join(', ', $faker->words($nb = 3)),

        'startedWorking' => $faker->date($format = 'Y-m-d', $max = 'now'),

        'landSize' => $faker->numberBetween(1, 1000),
        'landSizeUnit' => 'HA',

        'harvestAmount' => $faker->numberBetween(1, 100) ,
        'harvestAmountUnit' => $faker->randomElement(array ('KG','TON')),

        'locality' => $faker->city .', '. $faker->state,
        'latitude' => $faker->latitude(-90, 90),
        'longitude' => $faker->longitude(-180, 180)
    ];

});
