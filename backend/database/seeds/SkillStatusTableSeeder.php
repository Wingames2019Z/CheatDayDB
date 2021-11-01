<?php

use Illuminate\Database\Seeder;

class SkillStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $Time = 10;
        $IntervalTime = 600;
        $MaxLevel  =100;
        $AddTime = 1;
        $SubtractionTime = 6;
        for ($i = 1; $i <= $MaxLevel; $i++) 
        {
            if($i != 1){
                $Time = $Time + $AddTime;
                $IntervalTime = $IntervalTime - $SubtractionTime;
            }
             DB::table('skill_status')->insert([
              'level' => $i,
              'time' => $Time,
              'interval_time' => $IntervalTime,
        ]);
        }
    }

}
