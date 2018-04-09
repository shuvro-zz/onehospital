<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(patholab\User::class, function (Faker\Generator $faker) {
    $operator = [0, 1]; 	
    return [
        'name' => 'shammes',
        'email' => $faker->unique()->email,
        'password' => bcrypt('123-456'),
        'passcode' => '123-456',
        'operator' => 1,
        'username' => $faker->unique()->userName
    ];    
});


