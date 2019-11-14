<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('wallet_account', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ess_id');
            $table->string('wallet_type');
            $table->integer('wallet_account_type')->unsigned();
            $table->string('wallet_account_no');
            $table->string('wallet_account_name');
            $table->string('wallet_title')->nullable();
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
        Schema::connection('mysql')->dropIfExists('wallet_account');
    }
}
