<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountBalancesLedgerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql3')->create('account_balances_ledger', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('wallet_account_no');
            $table->string('account_type_code');
            $table->decimal('runnung_balance', 8, 3);
            $table->decimal('available_balance', 8, 2);
            $table->decimal('billed_balance', 8, 2);
            $table->decimal('txn_amount_day', 8, 2);
            $table->decimal('txn_amount_day_negative', 8, 2);
            $table->decimal('txn_amount_month', 8, 2);
            $table->decimal('txn_amount_month_negative', 8, 2);
            $table->decimal('txn_amount_year', 8, 2);
            $table->decimal('txn_amount_year_negative', 8, 2);
            $table->decimal('txn_cnt_day', 8, 2);
            $table->decimal('txn_cnt_day_negative', 8, 2);
            $table->decimal('txn_cnt_month', 8, 2);
            $table->decimal('txn_cnt_month_negative', 8, 2);
            $table->decimal('txn_cnt_year', 8, 2);
            $table->decimal('txn_cnt_year_negative', 8, 2);
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
        Schema::connection('mysql3')->dropIfExists('account_balances_ledger');
    }
}
