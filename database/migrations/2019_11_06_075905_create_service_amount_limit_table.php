<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceAmountLimitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('service_amount_limit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('service_id_amount');
            $table->integer('limit_minimum');
            $table->integer('limit_maximum');
            $table->integer('amount_per_day');
            $table->integer('amount_per_month');
            $table->integer('amount_per_year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->dropIfExists('service_amount_limit');
    }
}
