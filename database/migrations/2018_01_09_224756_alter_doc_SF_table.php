<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDocSFTable extends Migration
{
    public function up()
    {
        Schema::table('doc_SF', function ($table) {
            $table->bigInteger('farmer_pass_number')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('doc_SF', function ($table) {
            $table->bigInteger('farmer_pass_number')->change();
        });
    }
}
