<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalsTable extends Migration
{
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('docs_id')->nullable()->default(NULL);
            $table->integer('seller_id');
            $table->string('animal_id');
            $table->string('passport_id')->nullable();
            $table->string('herd_number');
            $table->string('sex');
            $table->integer('pot')->nullable();
            $table->date('dob');
            $table->string('cob');
            $table->string('pog');
            $table->string('breed');
            $table->string('inclination');
            $table->integer('created_by');
            $table->integer('real_weight');
            $table->integer('includable_weight');
            $table->float('price_kg', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('animals');
    }
}
