<?php

namespace App\Http\Controllers;

use App\Models\tproduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class TprodukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        
        if ($search) {
            $produk = tproduk::where('nama_produk', 'like', '%' . $search . '%')
                ->orWhere('deskripsi', 'like', '%' . $search . '%')
                ->get();
        } else {
            $produk = tproduk::all();
        }
        
        return view('produk.index', compact('produk', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
         return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric',
            'foto' => 'nullable|image|max:2048', // Maksimal 2MB
        ]);

        tproduk::create([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'foto' => $request->foto ? $request->file('foto')->store('produk', 'public') : null,
        ]);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(tproduk $tproduk)
    {
        return view('produk.show', compact('tproduk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tproduk $tproduk)
    {
        return view('produk.edit', compact('tproduk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tproduk $tproduk)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric',
            'foto' => 'nullable|image|max:2048',
        ]);

        $tproduk->nama_produk = $request->nama_produk;
        $tproduk->deskripsi = $request->deskripsi;
        $tproduk->harga = $request->harga;
        
        if ($request->hasFile('foto')) {
            $tproduk->foto = $request->file('foto')->store('produk', 'public');
        }
        
        $tproduk->save();

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tproduk $tproduk)
    {
        //
    }
}
