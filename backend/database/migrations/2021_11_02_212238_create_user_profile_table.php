<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfileTable extends Migration
{
/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('user_profile'))
        {
            Schema::create('user_profile', function (Blueprint $table) {
                $table->string('user_id', 37)->charset('utf8');
                $table->string('user_friend_id', 37)->charset('utf8');
                $table->string('user_name', 32)->charset('utf8');
                $table->integer('food_num')->default(0);
                $table->integer('tap')->default(0);
                $table->integer('eat_count')->default(0);
                $table->integer('level')->default(0);
                $table->integer('stage')->default(0);
                $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
                $table->primary('user_id');
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
