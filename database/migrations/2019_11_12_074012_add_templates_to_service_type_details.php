<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTemplatesToServiceTypeDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->table('servicetypedetails', function (Blueprint $table) {
                $table->string('acknowledgement_template')->after('st_description')->nullable();
                $table->string('approval_template')->after('acknowledgement_template')->nullable();
                $table->string('confirmation_template')->after('approval_template')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->table('servicetypedetails', function (Blueprint $table) {
                $table->dropColumn('acknowledgement_template');
                $table->dropColumn('approval_template');
                $table->dropColumn('confirmation_template');
        });
    }
}
