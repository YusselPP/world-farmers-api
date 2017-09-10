<?php

use Faker\Generator as Faker;

$factory->define(App\Contact::class, function (Faker $faker) {

    return [
        'name' => $faker->name,
        'phoneNumber' => $faker->phoneNumber,
        'products' => join(', ', $faker->words($nb = 3)),

        'experienceYears' => $faker->numberBetween(1, 50),
        'experienceYearsUnit' => $faker->randomElement(array ('YEAR','MONTH')),

        'landSize' => $faker->numberBetween(1, 1000),
        'landSizeUnit' => $faker->randomElement(array ('M2','HA2','KM2')),

        'harvestAmount' => $faker->numberBetween(10, 1000) ,
        'harvestAmountUnit' => $faker->randomElement(array ('GR','KG','TON','LT')),

        'locality' => $faker->city .', '. $faker->state,
        'latitude' => $faker->latitude(-90, 90),
        'longitude' => $faker->longitude(-180, 180)
    ];

});
