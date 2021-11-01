<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerTapDamage extends Model
{
    //table name
    protected $table = 'player_tap_damage';

    //variable
    protected $guarded = 
    [
        'level',
        'damage',
        'digit',
    ];
}
