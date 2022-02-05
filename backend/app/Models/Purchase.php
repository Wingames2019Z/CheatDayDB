<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{    //table name
    protected $table = 'purchase';
    public $incrementing = false;
    public $timestamps = true;
}
