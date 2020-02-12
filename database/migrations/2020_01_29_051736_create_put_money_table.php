<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePutMoneyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('put_money', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('wallet_id')->unsinged();
            $table->decimal('put_money_amount', 8, 2);
            $table->string('bank_name');
            $table->string('branch');
            $table->string('account_type');
            $table->string('account_name');
            $table->string('account_no');
            $table->string('deposit_slip');
            $table->string('remarks');
            $table->string('transaction_type');
            $table->boolean('put_money_status')->default(0)->unsgined();
            $table->integer('created_by')->unsinged();
            $table->integer('updated_by')->unsinged();
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
        Schema::connection('mysql')->dropIfExists('put_money');
    }
}
