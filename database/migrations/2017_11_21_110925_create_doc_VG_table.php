<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocVGTable extends Migration
{
    public function up()
    {
        Schema::create('doc_VG', function (Blueprint $table) {
            $table->increments('id');

            $table->string('sex')->nullable();
            $table->bigInteger('held_place_number')->nullable();
            $table->string('herd_number')->nullable();
            $table->string('held_adress')->nullable();
            $table->integer('travel_duration')->nullable();
            $table->string('serial');
            $table->string('no');

            $table->bigInteger('vet_pass_number')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('doc_VG');
    }
}
