<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\PlayerTapDamage;

class CreatePlayerTapDamageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('player_tap_damage')){
            Schema::create('player_tap_damage', function (Blueprint $table)  {
                $table->integer('level');
                $table->float('damage', 6, 2);
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
        Schema::dropIfExists('player_tap_damage');
    }
}
