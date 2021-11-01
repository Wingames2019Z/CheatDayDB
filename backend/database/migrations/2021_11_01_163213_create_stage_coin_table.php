<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\StageCoin;

class CreateStageCoinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('stage_coin')){
            Schema::create('stage_coin', function (Blueprint $table)  {
                $table->integer('stage');
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
        Schema::dropIfExists('stage_coin');
    }
}
