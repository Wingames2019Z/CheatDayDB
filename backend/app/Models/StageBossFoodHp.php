<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StageBossFoodHp extends Model
{
    //table name
    protected $table = 'stage_boss_food_hp';

    //variable
    protected $guarded = 
    [
        'stage',
        'hp',
        'digit',
    ];
}
