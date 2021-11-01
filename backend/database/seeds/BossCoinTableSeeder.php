<?php

use Illuminate\Database\Seeder;

class BossCoinTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $MaxStage = 1000;
        $GrowthRate = 1.136;
        $NeededCoin = 10;
        $NeededCoinDigit = 0;

        $Coin = 0;
        $CoinDigit = 0;

        $BossCoin = 0;
        $BossCoinDigit = 0;

        for ($i = 1; $i <= $MaxStage; $i++) {
            if($i == 1){

                $NeededCoin = 10;

            }else{

                $NeededCoin = $NeededCoin * $GrowthRate;
                if($NeededCoin > 1000){
                    $NeededCoin = $NeededCoin / 1000;
                    $NeededCoinDigit ++;
                }

                if($NeededCoinDigit == 0){
                    $NeededCoin = floor($NeededCoin);
                }

            }

            $Coin = $NeededCoin / 10;

            if($Coin < 1){
                $Coin = $Coin * 1000;
                $CoinDigit = $NeededCoinDigit -1;
            }else{
                $CoinDigit = $NeededCoinDigit;
            }



            $BossCoin = $Coin * 2.5;

            if($BossCoin > 1000){
                $BossCoin = $BossCoin / 1000;
                $BossCoinDigit = $CoinDigit + 1;
            }else{
                $BossCoinDigit = $CoinDigit;
            }

            if($BossCoinDigit == 0){
                $BossCoin = floor($BossCoin);
             }

            DB::table('boss_coin')->insert([
                'stage' => $i,
                'coin' => $BossCoin,
                'digit' => $BossCoinDigit,
            ]);

        }
     }
}
