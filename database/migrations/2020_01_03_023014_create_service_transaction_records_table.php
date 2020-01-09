<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceTransactionRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql3')->create('service_transaction_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('txn_date');
            $table->time('txn_time');
            $table->integer('txn_ref_no');
            $table->string('ess_id');
            $table->string('wallet_account_no');
            $table->string('svc_code');
            $table->string('merch_id');
            $table->string('merch_txn_no');
            $table->string('merch_svc_id');
            $table->decimal('amount_principal', 8, 2)->unsigned();
            $table->decimal('amount_interest', 8, 2)->unsigned();
            $table->decimal('amount_service_fee', 8, 2)->unsigned();
            $table->decimal('amount_total', 8, 2)->unsigned();
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
        Schema::connection('mysql3')->dropIfExists('service_transaction_records');
    }
}
