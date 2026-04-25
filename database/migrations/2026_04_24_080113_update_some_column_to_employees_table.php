<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSomeColumnToEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->integer('gender_id')->nullable()->after('gender');
            $table->integer('marriage_status_id')->nullable()->after('marriage_status');
            $table->integer('position_id')->nullable()->after('position');
            $table->integer('work_status_id')->nullable()->after('work_status');
            $table->integer('user_id')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn(['gender_id', 'marriage_status_id', 'position_id', 'work_status_id', 'user_id']);
        });
    }
}
