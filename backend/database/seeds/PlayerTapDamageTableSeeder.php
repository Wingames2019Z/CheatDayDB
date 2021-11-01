<?php

use Illuminate\Database\Seeder;
use App\Models\PlayerTapDamage;
class PlayerTapDamageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $MaxLevel = 2000;
        $GrowthRate =  1.092;
        $IncreaseNum = 1;
        $TapDamage = 1;
        $TapDamageDigit = 0;

        for ($i = 1; $i <= $MaxLevel; $i++) {

            if($i == 1){
                $TapDamage = 1;
                $TapDamageDigit = 0;
            }else{
                $IncreaseNum = $IncreaseNum * $GrowthRate;
                $TapDamage = $TapDamage + $IncreaseNum;
                if($TapDamage > 1000){
                    $TapDamage = $TapDamage / 1000;
                    $IncreaseNum  = $IncreaseNum  /1000;
                    $TapDamageDigit ++;
                }
            }
            $TapDamage = floor(($TapDamageDigit * 100) / 100);
            DB::table('player_tap_damage')->insert([
                'level' => $i,
                'damage' => $TapDamage,
                'digit' => $TapDamageDigit,
            ]);
        }

    }
}
