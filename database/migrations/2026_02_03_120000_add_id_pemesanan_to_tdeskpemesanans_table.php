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
        Schema::table('tdeskpemesanans', function (Blueprint $table) {
            // Add id_pemesanan to link detail rows to pemesanan
            $table->decimal('id_pemesanan')->nullable()->after('id');
            $table->index('id_pemesanan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tdeskpemesanans', function (Blueprint $table) {
            $table->dropIndex(['id_pemesanan']);
            $table->dropColumn('id_pemesanan');
        });
    }
};
