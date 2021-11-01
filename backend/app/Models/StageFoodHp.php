<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StageFoodHp extends Model
{
    //table name
    protected $table = 'stage_food_hp';

    //variable
    protected $guarded = 
    [
        'stage',
        'hp',
        'digit',
    ];
}
