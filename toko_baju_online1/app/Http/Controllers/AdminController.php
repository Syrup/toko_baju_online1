<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\tproduk;
use App\Models\tpemesanan;
use App\Models\tkonsumen;

class AdminController extends Controller
{
 public function index()
 {
 return $this->dashboard();
 }

 public function dashboard()
 {
 // Total Produk
 $totalProduk = tproduk::count();
 
 // Total Pesanan
 $totalPesanan = tpemesanan::count();
 
 // Total Pelanggan
 $totalPelanggan = tkonsumen::count();
 
 // Total Pendapatan (Total dari semua biaya pesanan)
 $totalPendapatan = tpemesanan::sum('total_biaya') ?? 0;
 
 // Pesanan terbaru (5 data terbaru)
 $pesananTerbaru = tpemesanan::orderBy('created_at', 'desc')->limit(5)->get();
 
 return view('admin.dashboard', [
 'totalProduk' => $totalProduk,
 'totalPesanan' => $totalPesanan,
 'totalPelanggan' => $totalPelanggan,
 'totalPendapatan' => $totalPendapatan,
 'pesananTerbaru' => $pesananTerbaru
 ]);
 }
}

