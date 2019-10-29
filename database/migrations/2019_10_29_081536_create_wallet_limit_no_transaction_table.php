<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletLimitNoTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('wallet_limit_no_transaction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('wlnt_id')->unsigned();
            $table->decimal('lm_per_day', 8, 2)->nullable();
            $table->decimal('lm_per_month', 8, 2)->nullable();
            $table->decimal('lm_per_year', 8, 2)->nullable();
            $table->decimal('allow_negative_balance', 8, 2)->nullable();
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
        Schema::connection('mysql')->dropIfExists('wallet_limit_no_transaction');
    }
}
