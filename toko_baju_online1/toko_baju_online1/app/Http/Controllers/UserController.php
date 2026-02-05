<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class UserController extends Controller
{
   public function index()
   {
      return $this->dashboarduser(); // redirect to data-backed dashboard
   }

   public function dashboarduser()
   {
      $total_produk = Schema::hasTable('t_produk') ? DB::table('t_produk')->count() : 0;
      $total_konsumen = Schema::hasTable('t_konsumen') ? DB::table('t_konsumen')->count() : 0;
      $total_pemesanan = Schema::hasTable('t_pemesanan') ? DB::table('t_pemesanan')->count() : 0;
      $total_belanja = Schema::hasTable('t_pemesanan') ? DB::table('t_pemesanan')->sum('total_biaya') : 0;
      $pesanan_aktif = Schema::hasTable('t_pemesanan') ? DB::table('t_pemesanan')->where('status', '!=', 'Selesai')->count() : 0;

      if (Schema::hasTable('t_pemesanan')) {
         $recent_orders = DB::table('t_pemesanan')
            ->leftJoin('t_konsumen', 't_pemesanan.id_konsumen', '=', 't_konsumen.id_konsumen')
            ->select(
               't_pemesanan.id_pemesanan',
               't_pemesanan.tanggal',
               't_pemesanan.total_biaya',
               't_pemesanan.status',
               't_konsumen.nama_konsumen'
            )
            ->orderBy('t_pemesanan.tanggal', 'desc')
            ->limit(8)
            ->get();
      } else {
         $recent_orders = collect();
      }

      // attach items for each recent order (if desk and produk tables exist)
      if ($recent_orders->isNotEmpty() && Schema::hasTable('t_desk_pemesanan') && Schema::hasTable('t_produk')) {
         foreach ($recent_orders as $o) {
            $items = DB::table('t_desk_pemesanan')
               ->join('t_produk', 't_desk_pemesanan.id_produk', '=', 't_produk.id_produk')
               ->where('t_desk_pemesanan.id_pemesanan', $o->id_pemesanan)
               ->select(
                  't_produk.id_produk',
                  't_produk.nama_produk',
                  't_produk.harga_produk',
                  't_desk_pemesanan.jumlah_beli',
                  't_desk_pemesanan.jumlah_harga'
               )
               ->get();

            $o->items = $items;
         }
      } else {
         foreach ($recent_orders as $o) {
            $o->items = collect();
         }
      }

      // latest products for dashboard
      $latest_products = Schema::hasTable('t_produk')
         ? DB::table('t_produk')
            ->select('id_produk','nama_produk','harga_produk','deskripsi_produk','ft_produk')
            ->orderBy('id_produk','desc')
            ->limit(8)
            ->get()
         : collect();

      return view('user.dashboard', compact(
         'total_produk',
         'total_konsumen',
         'total_pemesanan',
         'total_belanja',
         'pesanan_aktif',
         'recent_orders',
         'latest_products'
      ));
   }
}

