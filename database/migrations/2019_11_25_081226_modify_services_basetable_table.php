<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyServicesBasetableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->table('services_basetable', function (Blueprint $table) {
                    $table->renameColumn('services_id','service_id');
                    $table->renameColumn('services_group_id','service_group_id');
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
                  $table->renameColumn('service_id','services_id'); 
                  $table->renameColumn('service_group_id','services_group_id');
        });
    }
}
