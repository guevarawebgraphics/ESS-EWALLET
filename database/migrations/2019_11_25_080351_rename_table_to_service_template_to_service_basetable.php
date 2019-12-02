<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameTableToServiceTemplateToServiceBasetable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('services_basetable', function (Blueprint $table) {
                    $table->renameColumn('template','service_template');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services_basetable', function (Blueprint $table) {
                    $table->renameColumn('service_template','template');
        });
    }
}
