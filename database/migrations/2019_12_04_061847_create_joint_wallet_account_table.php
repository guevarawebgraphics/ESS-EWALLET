<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJointWalletAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('joint_wallet_account', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('wallet_account_id');
            $table->string('wallet_account_no');
            $table->string('joint_wallet_account_no');
            $table->string('cms_credit_account_no')->nullable();
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
        Schema::connection('mysql')->dropIfExists('joint_wallet_account');
    }
}
