<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBankNameColumnToWalletBankAccount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->table('wallet_bank_account', function (Blueprint $table) {
            $table->string('bank_name')->after('wallet_account_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->table('wallet_bank_account', function (Blueprint $table) {
            $table->dropColumn('bank_name');
        });
    }
}
