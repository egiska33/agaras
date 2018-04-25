<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDocVGTable extends Migration
{
    public function up()
    {
        Schema::table('doc_VG', function ($table) {
            $table->string('sex')->nullable()->change();
            $table->bigInteger('held_place_number')->nullable()->change();
            $table->bigInteger('herd_number')->nullable()->change();
            $table->string('held_adress')->nullable()->change();
            $table->integer('travel_duration')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('doc_VG', function ($table) {
            $table->string('sex')->change();
            $table->bigInteger('held_place_number')->change();
            $table->bigInteger('herd_number')->change();
            $table->string('held_adress')->change();
            $table->integer('travel_duration')->change();
        });
    }
}
