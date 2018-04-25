<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateWaybillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waybills', function ($table) {
            $table->increments('id');
            $table->integer('location_id');
            $table->string('waybill_no', 100);
            $table->string('sender', 100);
            $table->string('cosignee', 100);
            $table->string('origin', 100);
            $table->string('destination', 100);
            $table->string('transporter', 100);
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
        Schema::drop('waybills');

    }

}
