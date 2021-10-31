<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //table name
    protected $table = 'blogs';

    //variable
    protected $fillable = 
    [
        'title',
        'content'
    ];
}
