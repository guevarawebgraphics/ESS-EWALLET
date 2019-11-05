<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyStbehaviorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->table('stbehavior', function (Blueprint $table) {
                $table->dropColumn('added_ssw_sdw');
                $table->dropColumn('added_ssw_mdw');
                $table->dropColumn('added_msw_sdw');
                $table->dropColumn('added_msw_mdw');
                $table->dropColumn('deducted_sdw_ssw');
                $table->dropColumn('deducted_sdw_msw');
                $table->dropColumn('deducted_mdw_ssw');
                $table->dropColumn('deducted_mdw_msw');
                $table->string('behavior_value')->after('st_code');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->table('stbehavior', function (Blueprint $table) {
            $table->int('added_sww_sdw')->default(0)->unsigned();;
            $table->int('added_ssw_mdw')->default(0)->unsigned();;
            $table->int('added_msw_sdw')->default(0)->unsigned();;
            $table->int('added_msw_mdw')->default(0)->unsigned();;
            $table->int('deducted_sdw_ssw')->default(0)->unsigned();;
            $table->int('deducted_sdw_msw')->default(0)->unsigned();;
            $table->int('deducted_mdw_ssw')->default(0)->unsigned();;
            $table->int('deducted_mdw_msw')->default(0)->unsigned();;
            $table->dropColumn('behavior_value');
        });
    }
}
