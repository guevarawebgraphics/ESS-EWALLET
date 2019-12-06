<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnDefaultInWalletBankAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->table('wallet_bank_account', function (Blueprint $table) {
            $table->integer('default')->after('account_no')->unsigned();
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
            $table->dropColumn('default')->after('account_no');
        });
    }
}
