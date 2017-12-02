<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisposedAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disposed_assets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('asset_id');
            $table->string('asset_tag');
            $table->string('reason_for_dispose');
            $table->string('means');
            $table->string('requestor');
            $table->integer('location_id');
            $table->string('budget_holder');
            $table->string('country_director');
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
        Schema::drop('disposed_assets');
    }
}
