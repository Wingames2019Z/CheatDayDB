<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerNeededCoinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('player_needed_coin')){
            Schema::create('player_needed_coin', function (Blueprint $table)  {
                $table->integer('level');
                $table->float('coin', 6, 3);
                $table->integer('digit');s
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
        Schema::dropIfExists('player_needed_coin');
    }
}
