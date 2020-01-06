<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdbAndAduTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql3')->create('adb_and_adu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('wallet_account_no');
            $table->dateTime('sum_days_year');
            $table->dateTime('sum_days_month');
            $table->decimal('sum_run_bal_year', 8, 2)->unsigned();
            $table->decimal('sum_run_bal_month', 8, 2)->unsigned();
            $table->decimal('txn_amount_year', 8, 2);
            $table->decimal('txn_amount_month', 8, 2);
            $table->integer('adb_year');
            $table->integer('adb_month');
            $table->integer('adu_year');
            $table->integer('adu_month');
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
        Schema::connection('mysql3')->dropIfExists('adb_and_adu');
    }
}
