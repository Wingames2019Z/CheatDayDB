<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillStatusTable extends Migration
{
    public function up()
    {
    if(!Schema::hasTable('skill_status')){
        Schema::create('skill_status', function (Blueprint $table)  {
            $table->integer('level');
            $table->float('time', 6, 2);
            $table->float('interval_time', 6, 2);
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
    Schema::dropIfExists('skill_status');
   }
}
