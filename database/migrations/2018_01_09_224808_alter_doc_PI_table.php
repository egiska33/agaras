<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDocPITable extends Migration
{
    public function up()
    {
        Schema::table('doc_PI', function ($table) {
            $table->bigInteger('check_number')->nullable()->change();
            $table->string('paid_for')->nullable()->change();
            $table->bigInteger('invoice_number')->nullable()->change();
            $table->decimal('paid_sum', 8, 2)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('doc_PI', function ($table) {
            $table->bigInteger('check_number')->change();
            $table->string('paid_for')->change();
            $table->bigInteger('invoice_number')->change();
            $table->decimal('paid_sum', 8, 2)->change();
        });
    }
}
