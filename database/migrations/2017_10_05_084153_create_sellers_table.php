<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellersTable extends Migration
{
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->bigInteger('code');
            $table->string('seller_representative');
            $table->string('address');
            $table->string('pick_up_address');
            $table->string('pvm_code')->nullable();
            $table->string('pass_number')->nullable();
            $table->date('pass_issued_date')->nullable();
            $table->string('fooder', 255);
            $table->string('prosperity_evaluation');
            $table->string('possesion');
            $table->string('phone')->nullable();
            $table->string('pvm_rate')->nullable();
            $table->timestamp('last_vat_check')->nullable();
            $table->string('post_code')->nullable();
            $table->boolean('has_exemption')->default(0);
            $table->string('passport_number')->nullable();
            $table->date('passport_created_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sellers');
    }
}
