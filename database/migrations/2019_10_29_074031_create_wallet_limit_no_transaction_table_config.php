<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletLimitNoTransactionTableConfig extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('wallet_limit_no_transaction_config', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('wallet_account_id')->unsigned();
            $table->boolean('lm_per_day')->default(false)->unsigned();
            $table->boolean('lm_per_month')->default(false)->unsigned();
            $table->boolean('lm_per_year')->default(false)->unsigned();
            $table->boolean('allow_negative_balance')->default(false);
            $table->boolean('com_daily_balance')->default(false)->unsigned();
            $table->boolean('com_daily_usage')->default(false)->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
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
        Schema::connection('mysql')->dropIfExists('wallet_limit_no_transaction_table_config');
    }
}
