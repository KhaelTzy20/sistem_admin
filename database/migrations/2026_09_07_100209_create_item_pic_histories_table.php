<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemPicHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('item_pic_histories', function (Blueprint $table) {
            $table->id();

            // ID barang
            $table->integer('item_id');

            // ID PIC sebelumnya
            $table->integer('employee_id')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Foreign key
            $table->foreign('item_id')
                ->references('id')
                ->on('items')
                ->onDelete('cascade');

            $table->foreign('employee_id')
                ->references('id')
                ->on('employees')
                ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('item_pic_histories');
    }
}