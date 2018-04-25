<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsSerialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents_serials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('vat_invoice_serial');
            $table->string('vat_invoice_number');
            $table->string('invoice_serial');
            $table->string('invoice_number');
            $table->string('payout_check_serial');
            $table->string('payout_check_number');
            $table->string('sp_agreement_serial');
            $table->string('sp_agreement_number');
            $table->string('waybill_serial');
            $table->string('waybill_number');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents_serials');
    }
}
