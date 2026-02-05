<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tpemesanan extends Model
{
    protected $table = 'tpemesanans';
    protected $fillable = ['id_pemesanan', 'id_konsumen', 'total_biaya', 'status', 'tanggal'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_konsumen');
    }
}
