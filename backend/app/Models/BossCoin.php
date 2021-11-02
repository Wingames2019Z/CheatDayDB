<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BossCoin extends Model
{
       //table name
       protected $table = 'boss_coin';

       //variable
       protected $guarded = 
       [
           'stage',
           'coin',
           'digit',
       ];
   
}
