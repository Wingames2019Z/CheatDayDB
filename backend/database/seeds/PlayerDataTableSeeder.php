<?php

use Illuminate\Database\Seeder;
use App\Models\PlayerData;

class PlayerDataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
        }



    }


    // public function run()
    // {
    //     $MaxLevel = 2000;
    //     $DamageRate =  1.092;
    //     $IncreaseNum = 1;
    //     $TapDamage = 1;
    //     $TapDamageDigit = 0;

    //     for ($i = 1; $i <= $MaxLevel; $i++) {

    //         if($i == 1){
    //             $TapDamage = 1;
    //             $TapDamageDigit = 0;
    //         }else{
    //             $IncreaseNum = $IncreaseNum * $DamageRate;
    //             $TapDamage = $TapDamage + $IncreaseNum;
    //             if($TapDamage > 1000){
    //                 $TapDamage = $TapDamage / 1000;
    //                 $IncreaseNum  = $IncreaseNum  /1000;
    //                 $TapDamageDigit ++;
    //             }
    //         }
    //         $TapDamage = floor(($TapDamageDigit * 100) / 100);
    //         DB::table('player_tap_damage')->insert([
    //             'level' => $i,
    //             'damage' => $TapDamage,
    //             'digit' => $TapDamageDigit,
    //         ]);
    //     }

    // }


}
