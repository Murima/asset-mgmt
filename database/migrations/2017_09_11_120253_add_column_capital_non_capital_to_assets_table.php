<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnCapitalNonCapitalToAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //add column capital_non_capital for the checkbox
        Schema::table('assets', function ($table) {
            $table->tinyInteger('capital_non_capital')->nullable()->default(null);
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
        Schema::table('assets', function ($table) {
            $table->dropColumn('capital_non_capital');
        });
    }
}
