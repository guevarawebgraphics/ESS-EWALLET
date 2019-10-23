<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStBehaviorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('STBehavior', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->integer('st_id');
            $table->integer('st_code');
            $table->integer('added_ssw_sdw')->default(0)->unsigned();
            $table->integer('added_ssw_mdw')->default(0)->unsigned();
            $table->integer('added_msw_sdw')->default(0)->unsigned();
            $table->integer('added_msw_mdw')->default(0)->unsigned();
            $table->integer('deducted_sdw_ssw')->default(0)->unsigned();
            $table->integer('deducted_sdw_msw')->default(0)->unsigned();
            $table->integer('deducted_mdw_ssw')->default(0)->unsigned();
            $table->integer('deducted_mdw_msw')->default(0)->unsigned(); 
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
        Schema::connection('mysql')->dropIfExists('STBehavior');
    }
}
