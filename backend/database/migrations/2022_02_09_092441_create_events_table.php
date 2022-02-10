<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('events'))
        {
            Schema::create('events', function (Blueprint $table) {
                $table->string('event_id', 37)->charset('utf8');
                $table->string('start_date', 37)->charset('utf8');
                $table->string('end_date', 32)->charset('utf8');
                $table->string('scene_url', 32)->charset('utf8');
                $table->string('image_url', 32)->charset('utf8');
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
        Schema::dropIfExists('user_profile');
    }  

    
}
