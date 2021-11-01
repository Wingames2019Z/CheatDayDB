<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodPurchaseCoin extends Model
{
    //table name
    protected $table = 'food_purchase_coin';

    //variable
    protected $guarded = 
    [
        'num',
        'coin',
        'digit',
    ];
}
