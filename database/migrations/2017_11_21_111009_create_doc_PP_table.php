<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocPPTable extends Migration
{
    public function up()
    {
        Schema::create('doc_PP', function (Blueprint $table) {
            $table->increments('id');

            $table->string('bank')->nullable();
            $table->decimal('bull_price', 8, 2)->nullable();
            $table->decimal('heifer_price', 8, 2)->nullable();
            $table->decimal('cow_price', 8, 2)->nullable();
            $table->string('serial');
            $table->string('no');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('doc_PP');
    }
}
