<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountTransactionLedgerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql3')->create('account_transaction_ledger', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('txn_date');
            $table->time('txn_time');
            $table->string('wallet_account_no');
            $table->string('txn_ref_no');
            $table->decimal('amount_added_balance', 8, 2);
            $table->decimal('amount_deducted_balance', 8, 2);
            $table->decimal('running_balance', 8, 2);
            $table->decimal('available_balance', 8, 2);
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
        Schema::connection('mysql3')->dropIfExists('account_transaction_ledger');
    }
}
