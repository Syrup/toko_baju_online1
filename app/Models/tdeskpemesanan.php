<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tdeskpemesanan extends Model
{
    protected $table = 'tdeskpemesanans';
    protected $fillable = ['id_pemesanan', 'id_produk', 'jumlah', 'harga'];
}
