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

    do{
        $user_friend_id = random();
        $isExist = UserProfile::where('user_friend_id',$user_friend_id)->first();

    }while ($isExist);
//new
    return [
        'user_id' => $faker->uuid,
        'user_friend_id' => $user_friend_id,
        'user_name' => $faker->name,
        'title' => mt_rand(0, 9),
        'food_num' => mt_rand(0, 19),
        'tap' => mt_rand(100, 2000),
        'eat_count' => mt_rand(100, 5000),
        'level' => mt_rand(1, 100),
        'stage' => mt_rand(1, 100),
        'gift_diamonds' => 0,
    ];
});
function random($length = 7)
{
    return base_convert(mt_rand(pow(36, $length - 1), pow(36, $length) - 1), 10, 36);
}