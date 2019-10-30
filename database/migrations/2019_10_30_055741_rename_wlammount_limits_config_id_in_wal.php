<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameWlammountLimitsConfigIdInWal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->table('wallet_amount_limits', function (Blueprint $table) {
            $table->renameColumn('wallet_ammount_limits_config_id', 'wallet_amount_limits_config_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->table('wallet_amount_limits', function (Blueprint $table) {
            $table->renameColumn('wallet_amount_limits_config_id', 'wallet_ammount_limits_config_id');
        });
    }
}
