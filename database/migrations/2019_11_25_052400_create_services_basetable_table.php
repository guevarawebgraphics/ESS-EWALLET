<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesBasetableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_basetable', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('services_id');
            $table->integer('service_type_id');
            $table->integer('wallet_condition_id');
            $table->integer('pr_details_id');
            $table->integer('ir_details_id');
            $table->integer('service_gateway_id');
            $table->integer('assign_approver_id');
            $table->boolean('require_approver');
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
        Schema::connection('mysql')->dropIfExists('services_basetable');
    }
}
