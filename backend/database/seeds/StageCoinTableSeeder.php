<?php

use Illuminate\Database\Seeder;
use App\Models\StageCoin;

class StageCoinTableSeeder extends Seeder
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

            if($NeededCoinDigit == 0){
                $Coin = floor($Coin);
             }

            DB::table('stage_coin')->insert([
                'stage' => $i,
                'coin' => $Coin,
                'digit' => $CoinDigit,
            ]);

        }
     }
}
