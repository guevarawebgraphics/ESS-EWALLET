<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyServiceAmountLimitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_amount_limit', function (Blueprint $table) {
                $table->integer('service_id_amount')->nullable()->change();
                $table->integer('limit_minimum')->nullable()->change();
                $table->integer('limit_maximum')->nullable()->change();
                $table->integer('amount_per_day')->nullable()->change();
                $table->integer('amount_per_month')->nullable()->change();
                $table->integer('amount_per_year')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_amount_limit', function (Blueprint $table) {
                $table->integer('service_id_amount');
                $table->integer('limit_minimum');
                $table->integer('limit_maximum');
                $table->integer('amount_per_day');
                $table->integer('amount_per_month');
                $table->integer('amount_per_year');
        });
    }
}
