<?php

use Illuminate\Database\Seeder;
use App\Models\PlayerNeededCoin;

class PlayerNeededCoinTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $MaxLevel = 2000;
        $GrowthRate = 0.136;
        $NeededCoin = 10;
        $NeededCoinDigit = 0;

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
            

            DB::table('player_needed_coin')->insert([
                'level' => $i,
                'coin' => $NeededCoin,
                'digit' => $NeededCoinDigit,
            ]);
        }



    }
}
