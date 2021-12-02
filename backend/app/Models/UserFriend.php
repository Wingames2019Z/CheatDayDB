<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFriend extends Model
{
    protected $table = 'user_friend';
    public $incrementing = false;
    protected $primaryKey = 'user_id';
    public $timestamps = false;
}
