<?php

use Illuminate\Database\Seeder;
use App\Models\PlayerData;
use App\Models\StageData;
class PlayerDataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Player Data
        $MaxLevel = 2000;
        $CoinRate = 1.136;    
        //coin
        $NeededCoin = 10;
        $NeededCoinDigit = 0;
        //damage
        $DamageRate =  1.092;
        $IncreaseNum = 1;
        $TapDamage = 1;
        $TapDamageDigit = 0;

        //Stage HP
        $FoodHP = 0;
        $FoodHPDigit = 0;
        $BossHP = 0;
        $BossHPDigit = 0;

        $HPMultiply = 30;
        $BossMultiply = 60;

        //Stage Coin
        $Coin = 0;
        $CoinDigit = 0;
        $BossCoin = 0;
        $BossCoinDigit = 0;

        $CoinPercent = 10;//60
        $BossCoinPercent = 200;//400
        $DeductPercent = 0.5;//1
        $limit = 0.5; //1
        for ($i = 1; $i <= $MaxLevel; $i++) {
            if($i == 1){

                $NeededCoin = 10;

                $TapDamage = 1;
                $TapDamageDigit = 0;

            }else{

                $NeededCoin = $NeededCoin * $CoinRate;

                $IncreaseNum = $IncreaseNum * $DamageRate;
                $TapDamage = $TapDamage + $IncreaseNum;

                if($NeededCoin > 1000){
                    $NeededCoin = $NeededCoin / 1000;
                    $NeededCoinDigit ++;
                }

                if($NeededCoinDigit == 0){
                    $NeededCoin = floor($NeededCoin);
                }

                if($TapDamage > 1000){
                    $TapDamage = $TapDamage / 1000;
                    $IncreaseNum  = $IncreaseNum  /1000;
                    $TapDamageDigit ++;
                }

            }
            

            DB::table('player_data')->insert([
                'level' => $i,
                'coin' => $NeededCoin,
                'coin_digit' => $NeededCoinDigit,
                'damage' => $TapDamage,
                'damage_digit' => $TapDamageDigit,
            ]);

            //Food HP = damage * 30
            //Boss HP = damage * 120
            //Coin = 60% of Needed Coin to 1% of Needed Coin
            //Boss Coin = 400% of Needed Coin to 24% of Needed Coin

            //Food HP Set
            $FoodHP = $TapDamage * $HPMultiply;
            $FoodHPDigit = $TapDamageDigit;
            if($FoodHP > 1000){
                $FoodHP = $FoodHP / 1000;
                $FoodHPDigit ++;
            }
            if($FoodHPDigit == 0){
                $FoodHP = Floor($FoodHP);
            }

            //Boss Food HP Set
            $BossHP = $TapDamage * $BossMultiply;
            $BossHPDigit= $TapDamageDigit;
            if($BossHP > 1000){
                $BossHP = $BossHP / 1000;
                $BossHPDigit ++;
            }
            if($BossHPDigit == 0){
                $BossHP = Floor($BossHP);
            }

            //Stage Coin Set        
            if($CoinPercent >= $limit){
                if($i !=1){
                    $CoinPercent = $CoinPercent - ($CoinPercent * $DeductPercent /100);
                }
            }else if($CoinPercent < $limit){
                $CoinPercent = $limit;
            }
            $Coin = $NeededCoin * $CoinPercent  / 100;
            $CoinDigit = $NeededCoinDigit;
            if($Coin < 1){
                $Coin = $Coin * 1000;
                $CoinDigit --;
            }

            //Boss Coin Set
            if($BossCoinPercent >= $limit){
                if($i !=1){
                    $BossCoinPercent = $BossCoinPercent - ($BossCoinPercent * $DeductPercent /100);
                }         
            }else if($BossCoinPercent < $limit){
                $BossCoinPercent = $limit;
            }
            $BossCoin = $NeededCoin * $BossCoinPercent / 100;
            $BossCoinDigit = $NeededCoinDigit;
            if($BossCoin > 1000){
                $BossCoin = $BossCoin / 1000;
                $BossCoinDigit ++;
            }
            if($BossCoin < 1){
                $BossCoin = $BossCoin * 1000;
                $BossCoinDigit --;
            }
            
            DB::table('stage_data')->insert([
                'stage' => $i,
                'food_hp' => Floor($FoodHP * 100.0) / 100.0,
                'food_hp_digit' => $FoodHPDigit,
                'coin' =>  Floor($Coin * 100.0) / 100.0,
                'coin_digit' => $CoinDigit,
                'boss_food_hp' => Floor($BossHP * 100.0) / 100.0,
                'boss_food_hp_digit' => $BossHPDigit,
                'boss_coin' => Floor($BossCoin * 100.0) / 100.0,
                'boss_coin_digit' => $BossCoinDigit,
            ]);
        }
    }
}

// class CalculatorModel
// {
//     $Num = 0;
//     $Digit = 0;
// }

// function Multiply($num, $digit, $multiply)
// {
//     $calculatorModel = new CalculatorModel();
//     if ($multiply >= 1000){
//         return $calculatorModel;
//     }
    
//     $multiplied = 0;
//     $_calculatorModel = new CalculatorModel();

//     if ($multiply >= 1){
//         $multiplied = $num * $multiply;
//         $_calculatorModel = CarryUp($multiplied,$digit)
//     }
// }
// function CarryUp($num, $digit)
// {

// }
