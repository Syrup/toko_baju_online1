<?php

namespace App\Http\Controllers;

use App\Models\tproduk;
use Illuminate\Http\Request;

class UserKatalogController extends Controller
{
    /**
     * Display product catalog for customers (read-only).
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

        return view('user.katalog.index', compact('produk', 'search'));
    }

    /**
     * Display product detail for customers.
     */
    public function show($id)
    {
        $produk = tproduk::findOrFail($id);
        return view('user.katalog.show', compact('produk'));
    }
}
