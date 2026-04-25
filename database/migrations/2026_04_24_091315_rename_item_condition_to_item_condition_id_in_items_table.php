<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameItemConditionToItemConditionIdInItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->renameColumn('item_condition','item_condition_id');
            $table->renameColumn('item_status','item_status_id');
            $table->renameColumn('item_category','category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->renameColumn('item_condition_id','item_condition');
            $table->renameColumn('item_status_id','item_status');
            $table->renameColumn('category_id','item_category');
        });
    }
}
