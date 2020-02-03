<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusColumnToPrefundTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->table('prefund_transaction', function (Blueprint $table) {
            $table->string('wallet_id')->after('id')->nullable();
            $table->string('transaction_type')->after('remarks');
            $table->boolean('transaction_status')->after('transaction_type')->default(0)->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->table('prefund_transaction', function (Blueprint $table) {
            $table->dropColumn('wallet_id')->after('id');
            $table->dropColumn('transaction_type')->after('remarks');
            $table->dropColumn('transaction_status')->after('transaction_type');
        });
    }
}
