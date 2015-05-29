<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFriendsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_friends', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('user_to');
            $table->string('approved');
            $table->datetime('approved_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_friends');
    }

}
