<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletAmountLimitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('wallet_amount_limits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('wallet_ammount_limits_config_id')->unsigned();
            $table->decimal('am_minimum', 8, 2)->nullable();
            $table->decimal('am_maximum', 8, 2)->nullable();
            $table->decimal('am_transaction_minimum', 8, 2)->nullable();
            $table->decimal('am_transaction_maximum', 8, 2)->nullable();
            $table->decimal('am_day_minimum', 8, 2)->nullable();
            $table->decimal('am_day_maximum', 8, 2)->nullable();
            $table->decimal('am_month_minimum', 8, 2)->nullable();
            $table->decimal('am_month_maximum', 8, 2)->nullable();
            $table->decimal('am_year_minimum', 8, 2)->nullable();
            $table->decimal('am_year_maximum', 8, 2)->nullable();
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
        Schema::connection('mysql')->dropIfExists('wallet_amount_limits');
    }
}
