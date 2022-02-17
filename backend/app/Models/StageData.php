<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StageData extends Model
{
        //table name
        protected $table = 'stage_data';

        //variable
        protected $guarded = 
        [
            'stage',
            'food_hp',
            'food_hp_digit',
            'coin',
            'coin_digit',
            'boss_food_hp',
            'boss_food_hp_digit',
            'boss_coin',
            'boss_coin_digit',
        ];
}
