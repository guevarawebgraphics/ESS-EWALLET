<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('WDetails', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('wservice_id');
                $table->string('pr_wallet_type');
                $table->integer('pr_wallet_account_no');
                $table->integer('ir_wallet_account_no');
                $table->string('ir_wallet_account_name');
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
        Schema::connection('mysql')->dropIfExists('WDetails');
    }
}
