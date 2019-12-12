<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletServiceMatrixConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('wallet_service_matrix_config', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('wallet_account_id')->unsigned();
            $table->integer('service_id')->unsigned();
            $table->string('redeem');
            $table->integer('admin')->default(0)->unsigned();
            $table->integer('merchant')->default(0)->unsigned();
            $table->integer('branch')->default(0)->unsigned();
            $table->integer('agent')->default(0)->unsigned();
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
        Schema::connection('mysql')->dropIfExists('wallet_service_matrix_config');
    }
}
