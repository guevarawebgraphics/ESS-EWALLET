<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceMartixTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('service_martix', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('service_id')->unsigned();
            $table->integer('group_code_id')->unsigned();
            $table->string('redeem');
            $table->integer('admin_all')->default(0)->unsigned();
            $table->integer('admin_some')->default(0)->unsigned();
            $table->integer('merchant_all')->default(0)->unsigned();
            $table->integer('merchant_some')->default(0)->unsigned();
            $table->integer('branch_all')->default(0)->unsigned();
            $table->integer('branch_some')->default(0)->unsigned();
            $table->integer('agent_all')->default(0)->unsigned();
            $table->integer('agent_some')->default(0)->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
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
        Schema::connection('mysql')->dropIfExists('service_martix');
    }
}
