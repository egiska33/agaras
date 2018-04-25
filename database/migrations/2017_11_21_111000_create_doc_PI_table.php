<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocPITable extends Migration
{
    public function up()
    {
        Schema::create('doc_PI', function (Blueprint $table) {
            $table->increments('id');

            $table->bigInteger('check_number')->nullable();
            $table->string('paid_for')->nullable();
            $table->bigInteger('invoice_number')->nullable();
            $table->decimal('paid_sum', 8, 2)->nullable();
            $table->string('serial');
            $table->string('no');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('doc_PI');
    }
}
