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
        Schema::rename('seller_bank', 'sellers');

        Schema::table('sellers', function ($table) {
            $table->renameColumn('seller_bank', 'bank');
            $table->renameColumn('seller_bank_pay_account_number', 'bank_pay_account_number');

            $table->renameColumn('seller_email', 'email');
            $table->renameColumn('seller_fax', 'fax');
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
