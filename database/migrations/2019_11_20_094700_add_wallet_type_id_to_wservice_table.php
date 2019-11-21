<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWalletTypeIdToWserviceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->table('wservice', function (Blueprint $table) {
                $table->integer('wallet_type_id')->after('assign_approver_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->table('wservice', function (Blueprint $table) {
                $table->dropColumn('wallet_type_id');
        });
    }
}
