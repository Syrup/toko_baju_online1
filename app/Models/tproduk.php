<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tproduk extends Model
{
    protected $table = 'tproduks';
    protected $fillable = ['nama_produk', 'deskripsi', 'harga', 'foto'];
}
