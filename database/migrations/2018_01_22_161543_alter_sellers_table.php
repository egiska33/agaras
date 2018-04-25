<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sellers', function ($table) {
            $table->string('seller_bank')->nullable();
            $table->string('seller_bank_pay_account_number')->nullable();

            $table->string('seller_email')->nullable();
            $table->string('seller_fax')->nullable();
            $table->bigInteger('farmer_pass_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
