<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $table = 'events';
    public $incrementing = false;
    public $timestamps = true;
}
