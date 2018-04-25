<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocSFTable extends Migration
{
    public function up()
    {
        Schema::create('doc_SF', function (Blueprint $table) {
            $table->increments('id');

            $table->bigInteger('farmer_pass_number')->nullable();
            $table->string('serial');
            $table->string('no');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('doc_SF');
    }
}
