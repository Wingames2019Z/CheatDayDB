<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    //    $this->call(PlayerDataTableSeeder::class); 
    //    $this->call(FoodPurchaseCoinTableSeeder::class); 
    //    $this->call(SkillStatusTableSeeder::class); 

       $this->call(UserSeeder::class);        
    }
}
