<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tpemesanans', function (Blueprint $table) {
            $table->id();
            $table->decimal('id_pemesanan');
            $table->decimal('id_konsumen');
            $table->decimal('total_biaya');
            $table->string('status');
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tpemesanans');
    }
};
