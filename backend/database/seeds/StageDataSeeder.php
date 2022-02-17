<?php

use Illuminate\Database\Seeder;
use App\Models\StageData;
class StageDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $MaxStage = 600;

        //coin
        $Coin = 6; //6
        $_coin = $Coin;
        $CoinDigit = 0;
        $CoinRate = 1.116; //1.136f

        //food
        $FoodHP = 30; //30
        $_foodHP = $FoodHP;
        $FoodHPDigit = 0;
        $FoodHPRate = 1.136; //1.136

        //boss coin
        $BossCoin = 40;
        $_boss_coin = $BossCoin;
        $BossCoinDigit = 0;
        $BossCoinRate = 1.116;//1.136f

        //Boss HP
        $BossHP = 120;
        $_bossHP = $BossHP;
        $BossHPDigit = 0;
        $BossHPRate = 1.136;//1.136f



        for ($i = 1; $i <= $MaxStage; $i++) {
            if($i != 1){
                $Coin = $Coin * $CoinRate;
                $_coin = $Coin;
                if ($Coin > 1000)
                {
                    $Coin = $Coin / 1000;
                    $_coin = $Coin;
                    $CoinDigit++;
                }
                if ($CoinDigit == 0)
                {
                    $_coin = Floor($_coin);
                }

                $FoodHP = $FoodHP * $FoodHPRate;
                $_foodHP = $FoodHP;
                if ($FoodHP > 1000)
                {
                     $FoodHP = $FoodHP / 1000;
                    $_foodHP = $FoodHP;
                    $FoodHPDigit++;
                }
                if ($FoodHPDigit == 0)
                {
                    $_foodHP = Floor($_foodHP);
                }


                $BossCoin = $BossCoin * $BossCoinRate;
                $_boss_coin = $BossCoin;
                if ($BossCoin > 1000)
                {
                    $BossCoin = $BossCoin / 1000;
                    $_boss_coin = $BossCoin;
                    $BossCoinDigit++;
                }
                if ($BossCoinDigit == 0)
                {
                    $boss_coin = Floor($_boss_coin);
                }

                $BossHP = $BossHP * $BossHPRate;
                $_bossHP = $BossHP;
                if ($BossHP > 1000)
                {
                    $BossHP = $BossHP / 1000;
                    $_bossHP = $BossHP;
                    $BossHPDigit++;
                }
                if ($BossHPDigit == 0)
                {
                    $_bossHP = Floor($BossHP);
                }


            }
            

            DB::table('stage_data')->insert([
                'stage' => $i,
                'food_hp' => Floor($_foodHP * 100.0) / 100.0,
                'food_hp_digit' => $FoodHPDigit,
                'coin' =>  Floor($_coin * 100.0) / 100.0,
                'coin_digit' => $CoinDigit,
                'boss_food_hp' => Floor($_bossHP * 100.0) / 100.0,
                'boss_food_hp_digit' => $BossHPDigit,
                'boss_coin' => Floor($_boss_coin * 100.0) / 100.0,
                'boss_coin_digit' => $BossCoinDigit,
            ]);
        }



    }

}
