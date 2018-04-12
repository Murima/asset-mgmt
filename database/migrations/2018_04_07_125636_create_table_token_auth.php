<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTokenAuth extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('token_auth', function($table)
        {
            $table->increments('id');
            $table->string('username');
            $table->string('refresh_token',500);
            $table->string('access_token',500);
            $table->integer('expires_in');
            $table->integer('count');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('token_auth');
    }
}
