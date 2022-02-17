<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerData extends Model
{
    //table name
    protected $table = 'player_data';

    //variable
    protected $guarded = 
    [
        'level',
        'coin',
        'coin_digit',
        'damage',
        'damage_digit',
    ];
}
