<?php

namespace App\Http\Controllers;

use App\Models\tpemesanan;
use App\Models\tdeskpemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    /**
     * Display a listing of the user's orders.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $status = $request->query('status');

        $isAdmin = Auth::user() && Auth::user()->role === 'admin';

        if ($isAdmin) {
            $query = tpemesanan::query();
            $view = 'admin.pesanan.index';
        } else {
            $query = tpemesanan::where('id_konsumen', Auth::id());
            $view = 'user.pesanan.index';
        }

        // Filter by status if provided
        if ($status && $status !== 'semua') {
            $query->where('status', $status);
        }

        // Search by order ID or customer name
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('id_pemesanan', 'like', '%' . $search . '%')
                    ->orWhere('total_biaya', 'like', '%' . $search . '%');
            });
        }

        $pesanan = $query->orderBy('tanggal', 'desc')->get();

        return view($view, compact('pesanan', 'search', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $id_produk = $request->query('id_produk');
        if (!$id_produk) {
            return redirect()->route('user.katalog.index')->with('error', 'Pilih produk terlebih dahulu.');
        }

        $produk = \App\Models\tproduk::findOrFail($id_produk);
        $jumlah = $request->query('jumlah', 1);
        $keterangan = $request->query('keterangan', '');
        $total = $produk->harga * $jumlah;

        return view('pesanan.create', compact('produk', 'jumlah', 'keterangan', 'total'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        \Log::info('Checkout Request Data:', $request->all());

        // Ensure total_biaya is strictly a numeric value before validation
        if ($request->has('total_biaya')) {
            $request->merge([
                'total_biaya' => preg_replace('/[^0-9]/', '', $request->total_biaya)
            ]);
        }

        $request->validate([
            'id_konsumen' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'status' => 'required|in:pending,diproses,dikirim,selesai,dibatalkan',
            'total_biaya' => 'required|numeric',
        ]);

        // Generate a random ID for id_pemesanan (assuming it's a numeric ID based on decimal type)
        $generateId = rand(100000, 999999);

        // Create the main order
        $pesanan = tpemesanan::create([
            'id_pemesanan' => $generateId,
            'id_konsumen' => $request->id_konsumen,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
            'total_biaya' => $request->total_biaya,
        ]);

        // Save order details to tdeskpemesanan
        if ($request->has('id_produk') && $request->has('jumlah') && $request->has('harga')) {
            tdeskpemesanan::create([
                'id_pemesanan' => $pesanan->id,
                'id_produk' => $request->id_produk,
                'jumlah' => $request->jumlah,
                'harga' => $request->harga,
            ]);
        }

        return redirect()->route('user.pesanan.index')->with('success', 'Pesanan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(tpemesanan $pesanan)
    {
        $detailPesanan = tdeskpemesanan::where('id_pemesanan', $pesanan->id)->get();

        $isAdmin = Auth::user() && Auth::user()->role === 'admin';
        $view = $isAdmin ? 'admin.pesanan.show' : 'pesanan.show';

        return view($view, compact('pesanan', 'detailPesanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tpemesanan $pesanan)
    {
        $isAdmin = Auth::user() && Auth::user()->role === 'admin';
        $view = $isAdmin ? 'admin.pesanan.edit' : 'pesanan.edit';

        return view($view, compact('pesanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tpemesanan $pesanan)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,dikirim,selesai,dibatalkan',
        ]);

        $pesanan->update([
            'status' => $request->status
        ]);

        $isAdmin = Auth::user() && Auth::user()->role === 'admin';
        $route = $isAdmin ? 'admin.pesanan.show' : 'user.pesanan.show';

        return redirect()->route($route, $pesanan->id)->with('success', 'Status pesanan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tpemesanan $pesanan)
    {
        // Delete related detail pesanan first
        tdeskpemesanan::where('id_pemesanan', $pesanan->id)->delete();

        $pesanan->delete();

        $isAdmin = Auth::user() && Auth::user()->role === 'admin';
        $route = $isAdmin ? 'admin.pesanan.index' : 'user.pesanan.index';

        return redirect()->route($route)->with('success', 'Pesanan berhasil dihapus');
    }
}
