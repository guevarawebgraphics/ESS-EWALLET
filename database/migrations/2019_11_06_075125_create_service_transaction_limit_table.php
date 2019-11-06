<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceTransactionLimitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('service_transaction_limit', function (Blueprint $table) {
            $table->bigIncrements('id');   
            $table->integer('service_id_transaction');
            $table->integer('limit_per_day');
            $table->integer('limit_per_month');
            $table->integer('limit_per_year');
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
        Schema::connection('mysql')->table('service_transaction_limit', function (Blueprint $table) {
            $table->dropColumn('service_transaction_limit');
        });
    }
}
