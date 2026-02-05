<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PemesananSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        $data = [
            ['id_pemesanan' => 1001, 'id_konsumen' => 1, 'total_biaya' => 150000, 'status' => 'completed', 'tanggal' => $now->copy()->subDays(1)->toDateString(), 'created_at' => $now->copy()->subDays(1), 'updated_at' => $now->copy()->subDays(1)],
            ['id_pemesanan' => 1002, 'id_konsumen' => 2, 'total_biaya' => 250000, 'status' => 'processing', 'tanggal' => $now->copy()->subDays(2)->toDateString(), 'created_at' => $now->copy()->subDays(2), 'updated_at' => $now->copy()->subDays(2)],
            ['id_pemesanan' => 1003, 'id_konsumen' => 3, 'total_biaya' => 50000,  'status' => 'pending', 'tanggal' => $now->copy()->subDays(3)->toDateString(), 'created_at' => $now->copy()->subDays(3), 'updated_at' => $now->copy()->subDays(3)],
            ['id_pemesanan' => 1004, 'id_konsumen' => 1, 'total_biaya' => 175000, 'status' => 'completed', 'tanggal' => $now->copy()->subDays(4)->toDateString(), 'created_at' => $now->copy()->subDays(4), 'updated_at' => $now->copy()->subDays(4)],
            ['id_pemesanan' => 1005, 'id_konsumen' => 2, 'total_biaya' => 120000, 'status' => 'cancelled', 'tanggal' => $now->copy()->subDays(5)->toDateString(), 'created_at' => $now->copy()->subDays(5), 'updated_at' => $now->copy()->subDays(5)],
            ['id_pemesanan' => 1006, 'id_konsumen' => 4, 'total_biaya' => 300000, 'status' => 'completed', 'tanggal' => $now->copy()->subDays(6)->toDateString(), 'created_at' => $now->copy()->subDays(6), 'updated_at' => $now->copy()->subDays(6)],
            ['id_pemesanan' => 1007, 'id_konsumen' => 5, 'total_biaya' => 80000,  'status' => 'processing', 'tanggal' => $now->copy()->subDays(7)->toDateString(), 'created_at' => $now->copy()->subDays(7), 'updated_at' => $now->copy()->subDays(7)],
            ['id_pemesanan' => 1008, 'id_konsumen' => 1, 'total_biaya' => 95000,  'status' => 'completed', 'tanggal' => $now->copy()->toDateString(),            'created_at' => $now->copy(),                       'updated_at' => $now->copy()],
        ];

        DB::table('tpemesanans')->insert($data);
    }
}
