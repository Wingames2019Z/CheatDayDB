<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\StageData;
class CreateStageDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('stage_data')){
            Schema::create('stage_data', function (Blueprint $table)  {
                $table->integer('stage');
                $table->float('food_hp', 6, 2);
                $table->integer('food_hp_digit');
                $table->float('coin', 6, 2);
                $table->integer('coin_digit');
                $table->float('boss_food_hp', 6, 2);
                $table->integer('boss_food_hp_digit');
                $table->float('boss_coin', 6, 2);
                $table->integer('boss_coin_digit');
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
        Schema::dropIfExists('stage_data');
    }
}
