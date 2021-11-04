<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\PlayerData;

class CreatePlayerDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('player_data')){
            Schema::create('player_data', function (Blueprint $table)  {
                $table->integer('level');
                $table->float('coin', 6, 2);
                $table->integer('coin_digit');
                $table->float('damage', 6, 2);
                $table->integer('damage_digit');
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
        Schema::dropIfExists('player_data');
    }
}
