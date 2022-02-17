<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillStatus extends Model
{
    //table name
    protected $table = 'skill_status';

    //variable
    protected $guarded = 
    [
        'level',
        'time',
        'interval_time',
    ];
}
