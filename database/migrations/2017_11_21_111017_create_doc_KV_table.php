<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocKVTable extends Migration
{
    public function up()
    {
        Schema::create('doc_KV', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('vet_pass_number')->nullable();
            $table->bigInteger('user_travel_paper_number')->nullable();
            $table->string('serial');
            $table->string('no');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('doc_KV');
    }
}
