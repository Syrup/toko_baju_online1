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

        $query = tpemesanan::query();

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

        return view('user.pesanan.index', compact('pesanan', 'search', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pesanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_konsumen' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'status' => 'required|in:pending,diproses,dikirim,selesai,dibatalkan',
            'total_biaya' => 'required|numeric',
        ]);

        tpemesanan::create($request->all());

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(tpemesanan $pesanan)
    {
        $detailPesanan = tdeskpemesanan::where('id_pemesanan', $pesanan->id)->get();
        return view('pesanan.show', compact('pesanan', 'detailPesanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tpemesanan $pesanan)
    {
        return view('pesanan.edit', compact('pesanan'));
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

        return redirect()->route('pesanan.show', $pesanan->id)->with('success', 'Status pesanan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tpemesanan $pesanan)
    {
        // Delete related detail pesanan first
        tdeskpemesanan::where('id_pemesanan', $pesanan->id)->delete();

        $pesanan->delete();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dihapus');
    }
}
