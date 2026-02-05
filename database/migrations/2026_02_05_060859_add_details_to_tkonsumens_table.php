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
        Schema::table('tkonsumens', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('nomor_telepon')->nullable();
            $table->text('alamat')->nullable();
            $table->string('foto')->nullable();
        });

        $users = \App\Models\User::where('role', 'user')->get();
        foreach ($users as $user) {
            $exists = \Illuminate\Support\Facades\DB::table('tkonsumens')->where('user_id', $user->id)->exists();
            if (!$exists) {
                \Illuminate\Support\Facades\DB::table('tkonsumens')->insert([
                    'user_id' => $user->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tkonsumens', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'nomor_telepon', 'alamat', 'foto']);
        });
    }
};
