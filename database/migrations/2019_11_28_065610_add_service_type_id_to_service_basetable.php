<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddServiceTypeIdToServiceBasetable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->table('services_basetable', function (Blueprint $table) {
                $table->integer('service_type_id')->after('service_id');
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
                $table->dropColumn('service_type_id');
        });
    }
}
