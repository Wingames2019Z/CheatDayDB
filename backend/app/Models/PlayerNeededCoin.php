<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerNeededCoin extends Model
{
    //table name
    protected $table = 'player_needed_coin';

    //variable
    protected $guarded = 
    [
        'level',
        'coin',
        'digit',
    ];
}
