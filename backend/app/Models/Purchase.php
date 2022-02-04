<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{    //table name
    protected $table = 'Purchase';
    public $incrementing = false;
    protected $primaryKey = 'user_id';
    public $timestamps = true;
}
