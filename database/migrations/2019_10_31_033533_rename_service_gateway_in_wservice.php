<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameServiceGatewayInWservice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->table('WService', function (Blueprint $table) {
            $table->renameColumn('service_gateway', 'service_gateway_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->table('WService', function (Blueprint $table) {
            $table->renameColumn('service_gateway_id', 'service_gateway');
        });
    }
}
