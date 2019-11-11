<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyServiceTransactionLimitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_transaction_limit', function (Blueprint $table) {
                $table->integer('service_id_transaction')->nullable()->change();
                $table->integer('limit_per_day')->nullable()->change();
                $table->integer('limit_per_month')->nullable()->change();
                $table->integer('limit_per_year')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_transaction_limit', function (Blueprint $table) {
                $table->integer('service_id_transaction');
                $table->integer('limit_per_day');
                $table->integer('limit_per_month');
                $table->integer('limit_per_year');
        });
    }
}
