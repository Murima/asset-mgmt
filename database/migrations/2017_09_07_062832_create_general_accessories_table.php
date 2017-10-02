<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralAccessoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (!Schema::hasTable('general_accessories')) {
            Schema::create('general_accessories', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('category_id');
                $table->string('accessory_name');

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
        //
        Schema::dropIfExists('general_accessories');

    }
}
