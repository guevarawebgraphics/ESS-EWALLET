<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsInWalletAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->table('wallet_account', function (Blueprint $table) {
            $table->string('kyc_form')->after('wallet_title')->nullable();
            $table->string('valid_id')->after('kyc_form')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->table('wallet_account', function (Blueprint $table) {
            $table->dropColumn('kyc_form');
            $table->dropColumn('valid_id');
        });
    }
}
