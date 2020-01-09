<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceTypeDetailsBasetable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('service_type_details_basetable', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('services_id')->unsigned();
            $table->integer('service_type_details_id')->unsigned()->default(0);
            $table->integer('joint_services_id')->unsigned()->default(0);
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
        Schema::connection('mysql')->dropIfExists('service_type_details_basetable');
    }
}
