<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimeFieldsToSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sellers', function (Blueprint $table) {
            $table->string('travel_start_date')->nullable();
            $table->string('travel_start_time')->nullable();
            $table->integer('travel_duration')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sellers', function (Blueprint $table) {
            $table->dropColumn('travel_start_date')->nullable();
            $table->dropColumn('travel_start_time')->nullable();
            $table->dropColumn('travel_duration')->nullable();
        });
    }
}
