<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPeriodeToEquitiesTable extends Migration
{
    public function up()
    {
        Schema::table('equities', function (Blueprint $table) {

            $table->date('periode')
                ->nullable()
                ->after('company_name');

        });
    }

    public function down()
    {
        Schema::table('equities', function (Blueprint $table) {

            $table->dropColumn('periode');

        });
    }
}