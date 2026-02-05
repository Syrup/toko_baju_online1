<?php

namespace App\Http\Controllers;

use App\Models\tkonsumen;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        
        if ($search) {
            $pelanggan = tkonsumen::where('nama_konsumen', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('nomor_telepon', 'like', '%' . $search . '%')
                ->get();
        } else {
            $pelanggan = tkonsumen::all();
        }
        
        return view('pelanggan.index', compact('pelanggan', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_konsumen' => 'required|string|max:255',
            'email' => 'required|email|unique:tkonsumens',
            'nomor_telepon' => 'required|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        tkonsumen::create($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(tkonsumen $pelanggan)
    {
        return view('pelanggan.show', compact('pelanggan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tkonsumen $pelanggan)
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tkonsumen $pelanggan)
    {
        $request->validate([
            'nama_konsumen' => 'required|string|max:255',
            'email' => 'required|email|unique:tkonsumens,email,' . $pelanggan->id,
            'nomor_telepon' => 'required|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        $pelanggan->update($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tkonsumen $pelanggan)
    {
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus');
    }
}
