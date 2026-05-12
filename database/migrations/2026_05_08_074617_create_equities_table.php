<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('equities', function (Blueprint $table) {

            $table->id();

            // Nama perusahaan
            $table->string('company_name');

            // Nominal investasi/modal masuk
            $table->bigInteger('investment_amount')->default(0);

            // Persentase keuntungan / kerugian
            // contoh:
            // 10.50 = untung 10.5%
            // -5.20 = rugi 5.2%
            $table->decimal('roi_percentage', 8, 2)->default(0);

            // Nominal profit / loss
            $table->bigInteger('profit_loss_amount')->default(0);

            // Catatan tambahan
            $table->text('note')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equities');
    }
};