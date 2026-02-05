<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Schema::hasTable('t_produk') ? DB::table('t_produk')->get() : collect();
        return view('produk.index', compact('produk'));
    }

    public function show($id)
    {
        if (! Schema::hasTable('t_produk')) {
            abort(404);
        }

        $p = DB::table('t_produk')->where('id_produk', $id)->first();
        if (! $p) {
            abort(404);
        }

        return view('produk.show', compact('p'));
    }
}
