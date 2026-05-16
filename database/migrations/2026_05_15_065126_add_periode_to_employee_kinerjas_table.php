<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPeriodeToEmployeeKinerjasTable extends Migration
{
    public function up()
    {
        Schema::table('employee_kinerjas', function (Blueprint $table) {

            $table->date('periode')
                ->nullable()
                ->after('employee_id');

        });
    }

    public function down()
    {
        Schema::table('employee_kinerjas', function (Blueprint $table) {

            $table->dropColumn('periode');

        });
    }
}