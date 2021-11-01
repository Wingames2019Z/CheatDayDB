<?php

use Illuminate\Database\Seeder;
use App\Models\StageBossFoodHp;

class StageBossFoodHpTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $MaxLevel = 1000;
        $GrowthRate =  1.092;
        $IncreaseNum = 1;
        $TapDamage = 1;
        $TapDamageDigit = 0;

        $FoodRate = 60;
        $hp = 0;
        $digit = 0;

        for ($i = 1; $i <= $MaxLevel; $i++) {

            if($i == 1){
                $TapDamage = 1;
                $TapDamageDigit = 0;
                $hp = $TapDamage * $FoodRate;
            }else{
                $IncreaseNum = $IncreaseNum * $GrowthRate;
                $TapDamage = $TapDamage + $IncreaseNum;

                if($TapDamage > 1000){
                    $TapDamage = $TapDamage / 1000;
                    $IncreaseNum  = $IncreaseNum  /1000;
                    $TapDamageDigit ++;
                }
               // $TapDamageDigit = floor(($TapDamageDigit * 100) / 100);


                $hp = $TapDamage * $FoodRate;
                if($hp > 1000){
                    $hp= $hp / 1000;
                    $digit = $TapDamageDigit + 1;
                }
                // /$hp = floor(($hp * 100) / 100);
            }

            DB::table('stage_boss_food_hp')->insert([
                'stage' => $i,
                'hp' => $hp,
                'digit' => $digit,
            ]);
        }
    }



}
