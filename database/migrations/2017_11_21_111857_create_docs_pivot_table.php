<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocsPivotTable extends Migration
{
    public function up()
    {
        Schema::create('docs_pivot', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('vg_id')->nullable();
            $table->integer('sf_id')->nullable();
            $table->integer('pi_id')->nullable();
            $table->integer('pp_id')->nullable();
            $table->integer('kv_id')->nullable();

            $table->string('user_name');
            $table->string('user_phone', 25);
            $table->string('user_plate', 9);
            $table->string('user_position');
            $table->string('user_trailer_plates')->nullable();

            $table->string('seller_name');
            $table->bigInteger('seller_code');
            $table->string('seller_address');
            $table->string('seller_pvm_code')->nullable();
            $table->string('seller_phone')->nullable();
            $table->string('seller_pvm_rate')->nullable();
            $table->string('seller_pick_up_address');
            $table->string('seller_post_code')->nullable();
            $table->string('seller_position')->nullable();
            $table->string('seller_representative');

            $table->string('seller_pass_series_number')->nullable();
            $table->date('seller_pass_issued_date')->nullable();

            $table->string('seller_bank')->nullable();
            $table->string('seller_bank_pay_account_number')->nullable();

            $table->string('seller_email')->nullable();
            $table->string('seller_fax')->nullable();

            $table->string('travel_start_datetime')->nullable();
            $table->string('travel_arrive_datetime')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('docs_pivot');
    }
}
