<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeServiceMatrixTableColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->table('service_matrix', function (Blueprint $table) {
            $table->renameColumn('admin', 'admin_all');
            $table->boolean('admin_some')->default(false)->unsigned()->after('admin');
            $table->renameColumn('merchant', 'merchant_all');
            $table->boolean('merchant_some')->default(false)->unsigned()->after('merchant');
            $table->renameColumn('branch', 'branch_all');
            $table->boolean('branch_some')->default(false)->unsigned()->after('branch');
            $table->renameColumn('agent', 'agent_all');
            $table->boolean('agent_some')->default(false)->unsigned()->after('agent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->table('service_matrix', function (Blueprint $table) {
            $table->renameColumn('admin_all', 'admin');
            $table->dropColumn('admin_some');
            $table->renameColumn('merchant_all', 'merchant');
            $table->dropColumn('merchant_some');
            $table->renameColumn('branch_all', 'branch');
            $table->dropColumn('branch_some');
            $table->renameColumn('agent_all', 'agent');
            $table->dropColumn('agent_some');
        });
    }
}
