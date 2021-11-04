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
    //    $this->call(StageBossFoodHpTableSeeder::class);
    //    $this->call(PlayerNeededCoinTableSeeder::class);
    //    $this->call(PlayerTapDamageTableSeeder::class);
    //    $this->call(StageFoodHpTableSeeder::class);
    //    $this->call(StageCoinTableSeeder::class);
    //    $this->call(BossCoinTableSeeder::class);
       $this->call(PlayerDataTableSeeder::class); 
       $this->call(FoodPurchaseCoinTableSeeder::class); 
       $this->call(SkillStatusTableSeeder::class);        
    }
}
