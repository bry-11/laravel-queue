<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

// Factory definition to User
$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

// Factory definition to City
$factory->define(City::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'province_id' => $faker->province_id,
    ];
});

// Factory definition to Province
$factory->define(Province::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

// Factory definition to Identification Type
$factory->define(IdentificationType::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

// Factory definition to Sale Amount
$factory->define(SaleAmount::class, function (Faker $faker) {
    return [
        'min' => $faker->min,
        'max' => $faker->max,
    ];
});
