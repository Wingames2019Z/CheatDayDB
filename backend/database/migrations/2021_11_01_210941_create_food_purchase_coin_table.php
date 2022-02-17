<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\FoodPurchaseCoin;

class CreateFoodPurchaseCoinTable extends Migration{
    public function up()
    {
    if(!Schema::hasTable('food_purchase_coin')){
        Schema::create('food_purchase_coin', function (Blueprint $table)  {
            $table->integer('num');
            $table->float('coin', 6, 2);
            $table->integer('digit');
        });
    }
    }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
    Schema::dropIfExists('food_purchase_coin');
   }

}