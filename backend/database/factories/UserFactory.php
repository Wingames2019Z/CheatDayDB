<?php

use App\Models\UserProfile;
use Illuminate\Support\Str;
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

$factory->define(UserProfile::class, function (Faker $faker) {
    return [
        'user_id' => $faker->uuid,
        'user_name' => $faker->name,
        'tap' => mt_rand(100, 2000),
        'eat_count' => mt_rand(100, 5000),
        'level' => mt_rand(100, 2000),
        'stage' => mt_rand(100, 2000),
    ];
});
