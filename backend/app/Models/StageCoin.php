<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StageCoin extends Model
{
    //table name
    protected $table = 'stage_coin';

    //variable
    protected $guarded = 
    [
        'stage',
        'coin',
        'digit',
    ];
}
