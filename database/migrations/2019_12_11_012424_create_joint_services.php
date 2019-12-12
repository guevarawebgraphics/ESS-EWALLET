<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJointServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('joint_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('main_service_id');  // gets the main id (primary key) which is the newly created main service from the services table
            $table->integer('joint_service_id'); // gets the id (primary key) of the existing services jointed by the user.
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
        Schema::dropIfExists('joint_services');
    }
}
