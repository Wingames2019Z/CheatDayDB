<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\StageFoodHp;

class CreateStageFoodHpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('stage_food_hp')){
            Schema::create('stage_food_hp', function (Blueprint $table)  {
                $table->integer('stage');
                $table->float('hp', 6, 2);
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
        Schema::dropIfExists('stage_food_hp');
    }
}
