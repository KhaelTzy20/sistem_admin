<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('employee_warnings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')->constrained()->onDelete('cascade');

            $table->integer('level')->default(0); // 0 - 4
            $table->year('year'); // contoh: 2026

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['employee_id', 'year']); // 1 data per tahun
        });
    }

    public function down()
    {
        Schema::dropIfExists('employee_warnings');
    }
};