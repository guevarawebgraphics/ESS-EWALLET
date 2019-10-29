<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletAmmountLimitsConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('wallet_ammount_limits_config', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('wallet_account_id')->unsigned();
            $table->boolean('amount_limit')->default(false)->unsigned();
            $table->boolean('am_per_transaction')->default(false)->unsigned();
            $table->boolean('am_per_day')->default(false)->unsigned();
            $table->boolean('am_per_month')->default(false)->unsigned();
            $table->boolean('am_per_year')->default(false)->unsigned();
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
        Schema::connection('mysql')->dropIfExists('wallet_ammount_limits_config');
    }
}
