<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddServiceGroupAndTemplateToServiceBaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->table('services_basetable', function (Blueprint $table) {
                $table->integer('services_group_id')->after('service_gateway_id');
                $table->string('template')->after('require_approver');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->table('services_basetable', function (Blueprint $table) {
            //
        });
    }
}
