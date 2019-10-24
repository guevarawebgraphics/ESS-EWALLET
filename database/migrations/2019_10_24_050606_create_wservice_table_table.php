<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWserviceTableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('WService', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('service_code');
            $table->string('service_name');
            $table->string('service_description');
            $table->string('service_gateway');
            $table->string('service_template'); 
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
        Schema::connection('mysql')->dropIfExists('WService');
    }
}
