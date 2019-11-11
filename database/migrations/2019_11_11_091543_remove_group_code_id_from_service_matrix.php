<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveGroupCodeIdFromServiceMatrix extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->table('service_martix', function (Blueprint $table) {
            $table->dropColumn('group_code_id');
            $table->string('redeem')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::connection('mysql')->table('service_matrix', function (Blueprint $table) {
        //     //
        // });
    }
}
