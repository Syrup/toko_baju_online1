<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tdeskpemesanans', function (Blueprint $table) {
            $table->unsignedBigInteger('id_produk')->after('id_pemesanan');
            $table->integer('jumlah')->default(1)->after('id_produk');
            $table->decimal('harga', 15, 2)->after('jumlah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tdeskpemesanans', function (Blueprint $table) {
            $table->dropColumn(['id_produk', 'jumlah', 'harga']);
        });
    }
};
