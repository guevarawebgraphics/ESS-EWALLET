<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrefundTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('prefund_transaction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('prefund_amount', 8, 2);
            $table->string('name_of_bank');
            $table->string('branch');
            $table->string('account_type');
            $table->string('account_name');
            $table->string('account_no');
            $table->string('deposit_slip');
            $table->string('remarks');
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
        Schema::connection('mysql')->dropIfExists('prefund_transaction');
    }
}
