<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSvcLimitCounterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql3')->create('svc_limit_counter', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('wallet_account_no');
            $table->string('svc_code');
            $table->decimal('txn_amount_day', 8, 2);
            $table->decimal('txn_amount_month', 8, 2);
            $table->decimal('txn_amount_year', 8, 2);
            $table->integer('txn_count_day');
            $table->integer('txn_count_month');
            $table->integer('txn_count_year');
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
        Schema::connection('mysql')->dropIfExists('svc_limit_counter');
    }
}
