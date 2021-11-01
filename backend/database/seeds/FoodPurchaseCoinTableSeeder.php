<?php
use Illuminate\Database\Seeder;
class FoodPurchaseCoinTableSeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $MaxLevel = 1000;
        $GrowthRate = 0.136;
        $NeededCoin = 10;
        $NeededCoinDigit = 0;

        $num = 0;
        $Coin = 0;
        $Digit = 0;
        
        for ($i = 1; $i <= $MaxLevel; $i++) {
            if($i == 1){
                $NeededCoin = 10;
            }else{

                $NeededCoin = $NeededCoin * 1.136;
                if($NeededCoin > 1000){
                    $NeededCoin = $NeededCoin / 1000;
                    $NeededCoinDigit ++;
                }
                if($NeededCoinDigit == 0){
                    $NeededCoin = floor($NeededCoin);
                }
            }        
            $Remeinder = $i % 10;
            $Coin = $NeededCoin;
            $Digit = $NeededCoinDigit;

            if($Remeinder == 0){
                DB::table('food_purchase_coin')->insert([
                    'num' => $num,
                    'coin' => $Coin,
                    'digit' => $Digit,
                ]);
                $num++;
            }
        }
    }
}
